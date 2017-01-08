var mysql = require('mysql');
var net = require('net');
fs = require('fs');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : 'tho'
});

function reset()
{
    fs.truncate('log.txt');
}//reset log file
reset();
function conlog(text) {
    console.log(text);
    fs.appendFile('log.txt', text + '\r\n');
}//write to both terminal and log file

function log(text) {
    fs.appendFile('log.txt', text + '\r\n');
}//write on log file only

var server = net.createServer(function (socket) {
    var ipcli = socket.remoteAddress.toString();
    var porcli = socket.remotePort.toString();
    //conlog('A new connection from ' + ipcli + ' : ' + porcli);
    //custom variable for this connection
    //==================
    var dbname = '';
    var areaid;
    var plantid;
    var connected = 1;
    //==================
    var toptem;
    var bottem;
    var tophum;
    var bothum;
    var lig;
    //==================
    //==================
    //Cac bien luu tru gia tri trung binh cua moi truong
    var temtb = (bottem + toptem)/2;
    var humidtb;
    var lighttb;
    //==================
//======================
var humid = 70;
var light = 12000;
//======================
    function setinfo(var id)
    {
        var req = "SELECT `airtemp`, `humid`, `light` FROM `plantinfo`.`vegetable` WHERE id = " +id.toString();
    connection.query(req, function(err,rows)//execute the query
    {
        if (err)
        {
            console.log('Querry error:'+err.toString());
            return;
        }
        bottem = parseInt(rows[0].airtemp.split("-")[0]);
        toptem = parseInt(rows[0].airtemp.split("-")[1]);
        bothum = parseInt(rows[0].humid.split("-")[0]);
        tophum = parseInt(rows[0].humid.split("-")[1]);
        lig = parseInt(rows[0].humid);
    });
    }
    socket.on('error', function (data)
    {
        connected=0;
		log(ipcli+ ' port ' + porcli + '-->' + data.toString());
		//log(data.toString());
	});
    socket.on('data', function (chunk)
	{
        //log(chunk.toString());
        try
        {
            var packet=JSON.parse(chunk);
        }
        catch(e)
        {
           log(e); //error in the above string(in this case,yes)!
           //console.log('Parse JSON error!');
           return;
        }
        if(packet.type=='selectdb')
        {
            dbname = packet.dbname;
            areaid = packet.areaid;
            plantid = packet.plantid;
            socket.write('{"type" : "confirm", "message" : "db.selected"}');
            setTimeout(function () {check(); }, 10000);
            return;
        }
        if((packet.type=='data')&&(dbname!=''))
        {
            var ttemp = check_value(packet.temp, 1);
            var hhumid = check_value(packet.humid, 2);
            var llight = check_value(packet.light,3);
            var date = new Date().toLocaleString();
            var req = `INSERT INTO ${dbname}.data (time, areaid, temp, humid, light, plantid) VALUES ('${date}','${areaid}','${temp}','${humid}','${light}','${plantid}')`;
            connection.query(req, function(err,rows)//execute the query
            {
                if (err)
                {
                    log('Querry error:'+err.toString());
                    return;
                }
                return;
            });
            check(ttemp, hhumid, llight);
        }
        else if(packet.type=='data' && dbname=='')
        {
            var errmsg = '{ "type" : "error", "message" : "no.db.selected" }';
            socket.write(errmsg);
            return;
        }
    });
function check(temp, humid, light)
{
    //khai bao cac bien se su dung, tuy bien theo thoi gian
    var ttoptemp;
    var tbottemp;
    var d = new Date(); //lay thoi gian hien tai
    var n = d.getHours(); //lay gio tu ngay
    if((n >= 8)&&(n <= 16))
    {
        ttoptemp = toptem - 2;
        tbottemp = bottem - 2;
    }
    else
    {
        ttoptemp = toptem;
        tbottemp = bottem;
    }
    if(connected==1)
    {
        
		//======Nhiet do=======
		if(temp >= toptem)
	    {
            socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "temp-down", "level" : "1"}');
            log("{$dbname}.{$areaid} can ha nhiet do");
            return;
  		}
        else if (temp <= bottem)
        {
            socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "temp-up", "level" : "1"}');
            log("{$dbname}.{$areaid} can tang nhiet do!");
            return;
        }

        /*
        //======Do am=======
        if((bothum - 20 <= hhumid)&&(hhumid <= bothum))
        {
            socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "water", "level" : "2"}');
            log("Can nuoc muc do 2");
            return;
        }
        else if (hhumid < bothum - 20)
        {
            socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "water", "level" : "1"}');
            log("Can nuoc muc do 1");
            return;
        }

        //======Anh sang=======
		if(llight >= 15000)
        {
           socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "light-down", "level" : "1"}');
          log("Can ha anh sang");
          return;
        }
        else if (llight<=5000)
        {
       	    socket.write('{"type" : "alert", "areaid" : "'+areaid+'", "target" : "light-up", "level" : "1"}');
            log("Can tang anh sang");
            return;
        }
		

       */
    setTimeout(function () {check(); }, 5000);//set timeout 5 seconds
    }
    }//end of check function
//check();
    var check_value(vaue1, kind)
    {
        //kind : Nhiet do: 1, Do am: 2, Anh sang: 3
        if (kind=='1')
        {
                if((value1 - temtb)>5)
                    return temtb;
                temtb = (temtb + value1)/2;
                return value1;
        }
        //return chi de chac rang se co ket qua tra ve
        return value1;
        //code cho phan xu li do am va anh sang
    }
    socket.on('end', function () 
	{
        log('Mot thiet bi da ngat ket noi!');
        connected=0;
    });
});
server.listen(1334, '192.168.1.50' ,mess());//server start listening
function mess() {
    conlog(new Date().toLocaleString()+ ' Server started...');
}
//-------------------------------------------------------------//
