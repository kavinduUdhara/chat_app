<!DOCTYPE html>
<html lang="en">
<?php

use LDAP\Result;

session_start();
if (isset($_SESSION['email'])) {
    //take user information
    $user_email = $_SESSION['email'];
    $conn = new mysqli('localhost', 'root', '@DBMS15302sql', 'chat_app');
    $sql = "SELECT * FROM acc_info WHERE email = '$user_email' LIMIT 1;";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    $user_id = $row["id"];
    $user_first_name = $row['first_name'];
    $user_last_name = $row['last_name'];
} else {
    header(('Location: ./sign-in'));
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the chat app</title>
    <link rel="stylesheet" href="../jquery-ui-1.13.2/jquery-ui.css">
    <script src="./j-query/jquery-3.6.1.min.js"></script>
    <script src="./jquery-ui-1.13.2/jquery-ui.js"></script>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        <?php
        //create JS var. to store user information
        echo "var user_email = '$user_email';\n";
        echo "var user_id = '$user_id';\n";
        echo "var user_first_name = '$user_first_name';\n";
        echo "var user_last_name = '$user_last_name';\n";
        ?>
        $(function() {
            $('#user_name').text(user_first_name + " " + user_last_name);
            $('#user_email').text(user_email)
        });
    </script>
</head>

<body>
    <div class="popup" id="popup1">
        <div class="massage">
            <div class="close" onclick="popup('close')">
                <img src="images/svg/close-outline.svg" alt="">
            </div>
            <div class="title" id="popup-title">Add a new contact</div>
            <div class="dis">
                <div class="add-new-c" id="add-new-c">
                    <input type="email" id="new-c-email" placeholder="email">
                    <div class="action" onclick="action('add_new_c')">
                        <img id="action-image" src="images/svg/add-outline.svg" alt="add-outline">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="left">
        <div class="dashbord av-select">
            <div class="acc-info-and-sort">
                <div class="acc-info">
                    <img class="acc-img" src="images/default-images/profile-icon-2.png" alt="profile-icon">
                    <div class="acc-name-username">
                        <div class="acc-name" id="user_name">acc name</div>
                        <div class="acc-username" id="user_email">acc email</div>
                    </div>
                    <div class="acc-options">
                        <img src="images/svg/caret-down-circle-outline.svg" alt="drop-down">
                    </div>
                </div>
                <div class="sort">
                    <!--this part wanna develp with databases-->
                </div>
            </div>
            <div class="chat-list">
                <?php
                //select * from contacts where from_acc = 6 or (to_acc = 6 and status = 'pending') order by (last_updated) desc;
                /* 
                mysql> 
    select contacts.from_acc,
    contacts.to_acc,
    contacts.status,
    acc_info.email,
    acc_info.first_name,
    acc_info.last_name
    from contacts
    inner join acc_info
    on contacts.from_acc = acc_info.id or contacts.to_acc = acc_info.id
    where from_acc = 6 or (to_acc = 6 and contacts.`status` = 'pending') order by (last_updated) desc;
                */
                //where (from_acc = 6 or (to_acc = 6 and contacts.`status` = 'pending')) and (acc_info.id != 6 or from_acc = to_acc) order by (last_updated) desc;
                $sql = "SELECT contacts.from_acc, contacts.to_acc, contacts.status, contacts.latest_massage, contacts.unreaded_msgs, 
                acc_info.email, acc_info.first_name, acc_info.last_name
                FROM contacts INNER JOIN acc_info ON contacts.from_acc = acc_info.id OR contacts.to_acc = acc_info.id
                where (from_acc = 6 OR (to_acc = 6 AND contacts.`status` = 'pending')) 
                AND (acc_info.id != 6 OR from_acc = to_acc) 
                order by (last_updated) desc;";

                $result = $conn->query($sql);

                //<div class="empty-chat-list">click the button bellow to add a new contact</div>
                if (!$result->num_rows > 0){
                    echo '<div class="empty-chat-list">click the button bellow to add a new contact</div>';
                }

                for ($x = 0; $x < $result->num_rows; $x++){
                    $row = mysqli_fetch_assoc($result);

                    $from_acc_id = $row['from_acc'];
                    $to_acc_id = $row['to_acc'];
                    $acc_email = $row['email'];
                    $status = $row['status'];

                    if($status == 'pending'){
                        if($from_acc_id != $user_id){
                            $js_function = "load_chat_history($from_acc_id, '$acc_email', '$status', 'to_user')";
                            $latest_message = 'You got a new contact';
                        } else {
                            $js_function = "load_chat_history($to_acc_id, '$acc_email', '$status', 'from_user')";
                            $latest_message = 'Your request has been sent';
                        }
                    } else{
                        $js_function = "load_chat_history($to_acc_id, '$acc_email', '$status', 'normal')";
                        $latest_message = $row['latest_massage'];
                    }

                    echo "<div class=\"chat-item\" ";
                    echo "onclick=\"$js_function\"";
                    echo ">\n";
                    echo "<div class=\"profile-img-def\">".$row['first_name'][0]."</div>\n";
                    echo "<div class=\"acc-name-and-latest-msg\">\n";
                    echo $row['first_name']." ".$row['last_name']."<br>";
                    echo "<div class=\"acc-name\">\n";
                    echo "<div>$latest_message</div>\n";
                    echo "</div>\n";
                    echo "<div class=\"other-info\"";
                    if ($status == 'pending' and $from_acc_id == $user_id){
                            echo " style=\"background-color: darkgoldenrod\"";
                        }
                    echo ">\n";
                    if ($status == 'pending'){
                        echo "<div class=\"new-request\">\n<img src=\"images/default-images/svg/person-add-outline-white.svg\" alt=\"\">\n</div>";
                    } else{
                        echo "<div class=\"new-msgs\">".$row['unreaded_msgs']."</div>";
                    }
                    echo "</div>\n";
                    
                    echo "</div>\n</div>";
                }
                ?>
            </div>
            <div class="add-contact">
                <div class="btn" onclick="popup('add_new_c')">
                    <img src="images/default-images/svg/person-add-outline.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="chat-box">
            <div class="non-selected-chat">
                <div class="title av-select">Select a chat</div>
                <div class="logo-and-text">
                    <div class="logo">
                        <img src="images/svg/chatbubbles-outline.svg" alt="chat app">
                    </div>
                    <div class="text">select on a contact to display the chat history</div>
                </div>
            </div>
            <div class="loading-chat">
                <div class="holder">
                    <img src="images/svg/cloud-download-outline.svg" alt="">
                    <p>Loading chat history</p>
                </div>
            </div>
            <div class="loaded-chat">
                <div class="acc-info">
                    <img class="acc-img" src="images/default-images/profile-icon-2.png" alt="profile-icon">
                    <div class="profile-img-def">M</div>
                    <div class="acc-name-username">
                        <div class="acc-name">Manula Hansaka</div>
                        <div class="acc-username">mdmanulahansaka@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="load-info">load info</div>
</body>

</html>