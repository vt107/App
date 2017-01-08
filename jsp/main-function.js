function ssinf_load()
{
    setTimeout(function () {
        load_main_gadget(true);
    }, 10000);
    setTimeout(function () {
        load_table();
    }, 2000);
}
function load_main_gadget(input) //value de xac dinh co lap lai hay khong
{
    $.ajax({
        url : "php/main-gadget.php",
        type : "post",
        dateType:"json",
        data : {
             AreaID : $('#areaselect').val(),
             // User : $_SESSION['username'],
             // Database : $_SESSION['database']
        },
        success : function (result){
            //$('#result').html(result);
            var myjson = jQuery.parseJSON(result);
            if(myjson.Err=='1')
            {
                show_popup('myPopup');
                return;
            }
            var popup = document.getElementById('myPopup');
            popup.classList='popuptext';
            //alert(myjson.AreaID);
            $('#Area').html(myjson.AreaID);
            $('#Tem').html(myjson.Temp + " &ordm;C");
            $('#Humi').html(myjson.Humid + " %");
            $('#Ligh').html(myjson.Light + " Lx");
            //tach lay 3 gia tri de su dung mau sao cho hop li
            var te = parseFloat(myjson.Temp);
            var hu = parseFloat(myjson.Humid);
            var li = parseFloat(myjson.Light);
            //Chon cac muc do mau tuong ung de hien thi
            //Nhiet do
            if (between(0, te, 20))
                $('#Temp').css('background-color', '#B8CAEF');
            else if (between(20, te, 35))
                $('#Temp').css('background-color', '#5CB85C');
            else if (between(35, te, 45))
                $('#Temp').css('background-color', '#F0AD4E');
            else
                $('#Temp').css('background-color', '#D9534F');
            //Do am
            if (between(0, hu, 45))
                $('#Humid').css('background-color', '#B8CAEF');
            else if (between(45, hu, 75))
                $('#Humid').css('background-color', '#5CB85C');
            else if (between(75, hu, 85))
                $('#Humid').css('background-color', '#F0AD4E');
            else
                $('#Humid').css('background-color', '#D9534F');
            //Anh sang
            if (between(0, li, 200))
                $('#Light').css('background-color', '#B8CAEF');
            else if (between(200, li, 2000))
                $('#Light').css('background-color', '#5CB85C');
            else if (between(2000, li, 3000))
                $('#Light').css('background-color', '#F0AD4E');
            else
                $('#Light').css('background-color', '#D9534F');
        }
    });
// var myvar = document.getElementById("areaselect").value;
if(input)
{
	setTimeout(function () {
        load_main_gadget(true);
    }, 10000);
}
}
function between(a, input, b)
{
    if((a<=input)&&(input<b))
        return true;
    return false;
}
function load_table()
{
    $.ajax({
        url : "php/main-table.php",
        type : "post",
        dateType:"text",
        data : {
            limit : '6'
        },
        success : function (result){
            $('#sub').html(result);
        }
    });
    setTimeout(function () {
        load_table();
    }, 2000);
}
function show_popup(name)
{
    var popup = document.getElementById(name);
    popup.classList.toggle('show');
}
function menu_load(menu_item, menu_item_value)
{
    //update menu
    $.ajax({
        url : "php/main-menu.php",
        type : "post",
        dateType:"text",
        data : {
            selected : menu_item_value
        },
        success : function (result){
            $('#menu').html(result);
        }
    });
    //update content
    $.ajax({
        url : "php/"+menu_item+".php",
        type : "post",
        dateType:"text",
        data : {
            
        },
        success : function (result){
            $('#content').html(result);

            if(menu_item=="ssinfo")
                ssinf_load();
        }
    });
}
