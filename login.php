
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style/loginstyle.css" /> 
        <title>Đăng nhập</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body style="background-image: url(img/loginbgr.jpg); background-size: cover;">
    <div id="my-form">
        <form action='login.php?do=login' method='POST'>
        <div>
            <h1>Đăng nhập</h1>
        </div>
        <div class="login-container">
                <?php
                //Khai báo sử dụng session
                session_start();
                 
                //Xử lý đăng nhập
                if (isset($_POST['login'])) 
                {
                    //Kết nối tới database
                    include('php/check-login.php');
                     
                    //Lấy dữ liệu nhập vào
                    $username = addslashes($_POST['txtUsername']);
                    $password = addslashes($_POST['txtPassword']);
                     
                    // mã hóa pasword
                    //$password = md5($password);
                     
                    //Kiểm tra tên đăng nhập có tồn tại không
                    $query = mysql_query("SELECT * FROM user WHERE username='$username'");
                    if (mysql_num_rows($query) == 0) {
                        echo "<span>Tên đăng nhập không tồn tại.</span>";
                    }
                    else
                    {
                        //Lấy mật khẩu trong database ra
                        $row = mysql_fetch_array($query);
                         
                        //So sánh 2 mật khẩu có trùng khớp hay không
                        if ($password != $row['password']) {
                            echo "<span>Sai mật khẩu!</span>";
                        }
                        else
                        {
                            $_SESSION['username'] = $username;
                            $_SESSION['database'] = $password;
                            $_SESSION['password'] = $row['farm'];
                            $_SESSION['name'] = $row['name'];
                            $url = 'index.php';
                            header( "Location: $url" );
                        }
                    }
                }
                ?>
        <!-- <span>xxx</span> -->
            <input type="text" placeholder="Tên tài khoản" required="" name="txtUsername"/>
        </div>
        <div>
            <input type="password" placeholder="Mật khẩu" required="" name="txtPassword"/>

        </div>
        <input type='submit' name="login" value='Đăng nhập' />
        <a href='mailto:iotsmartfarming@gmail.com' title='Đăng ký' style="color: blue; text-decoration: none;">Chưa có tài khoản?</a>
        </form>
        </div>
    </body>
</html>