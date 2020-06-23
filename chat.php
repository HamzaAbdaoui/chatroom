<?php
session_start();
if(!isset($_SESSION['loggedUser']))
    header('Location:index.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
#connectedList {
    height: auto;
    background-color: aliceblue;
    border: 1px blue solid;
    border-radius: 5px;
    max-height: 100vh;
}

#discussion {
    height: 90%;
    background-color: #eeeeee;
    border: 1px grey solid;
    border-radius: 5px;
    max-height: 100vh;
    overflow: scroll;
}

#inputZone {
    position: absolute;
    bottom: 0;
    right: 0px;
}

.bulle-send {
    float: right;
    background-color: cornflowerblue;
    width: 90%;
    margin-left: 10%;
    margin-bottom: 5px;
    border-radius: 7px 0px 0 7px;
    padding-top: 4px;
    padding-bottom: 4px;
    text-align: right;
    padding-left: 10px;
    padding-right: 10px;
}

.bulle-receive {
    float: left;
    background-color: darkgrey;
    width: 90%;
    margin-right: 10%;
    margin-bottom: 5px;
    border-radius: 0px 7px 7px 0px;
    padding-top: 4px;
    padding-bottom: 4px;
    text-align: left;
    padding-left: 10px;
    padding-right: 10px;
}
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

    <div class='container mt-2 text-center' style='height:100vh'>
        <div class='row mt-2' style='height:100%'>
            <div class='col-3 mt-2' id='connectedListDiv' >
            <div class="alert alert-info" role="alert">
                <?php
                    echo $_SESSION['loggedUser']['name'];
                ?>
            </div>
                <ul class="list-group" id='connectedList'>
                </ul>
            </div>
            <div class='col-9' id='discussion'>
                <div id='displayMsg'>
                    Please select a member
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8">
                <div class="input-group mb-3" id='inputZone' hidden>
                    <input type="text" id='msgZone' class="form-control" placeholder="Entrez votre message" aria-label="message" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Envoyer</button>
                    </div>
                    <input type="hidden" id="selectedUserId">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function(){
            setInterval(function(){
                // Get users
                $.get('chat-script.php', {fnct: 'getUsers'}, function(data){
                    // display users
                    connectedList = $('#connectedList');
                    users = JSON.parse(data);

                    connectedList.empty();

                    logged = '<span class="text-success"><i class="fa fa-circle"></i></span>';
                    notLogged = '<span class="text-danger"><i class="fa fa-circle"></i></span>';

                    users.forEach(user => {
                        if(user.logged_in == 1)
                            connectedList.append('<li class="list-group-item user-li" id="'+user.id+'" >'+user.nom+' '+logged+' </li>');
                        else 
                            connectedList.append('<li class="list-group-item user-li" id="'+user.id+'">'+user.nom+' '+notLogged+' </li>');
                    });

                    alreadySelectedUser = $('#selectedUserId').val();
                    if(alreadySelectedUser != ''){
                        $('#'+alreadySelectedUser).css('background-color', '#eee');
                        getMessages(alreadySelectedUser);

                        $('#msgZone').unbind( "keyup" );
                        $('#msgZone').keyup(function(e){ 
                            var code = e.key;
                            if (code == 'Enter') {
                                msgToSend = $(this).val();
                                if (msgToSend != '')
                                    $.post('chat-script.php', {fnct: 'sendMessage', otherId: alreadySelectedUser, message: msgToSend}, function(data){
                                        $('#msgZone').val('');
                                    });
                            }
                        });

                        //Send message
                        $('button').unbind( "click" );
                        $('button').on('click', function(){
                            msgToSend = $('#msgZone').val();
                            if (msgToSend != '')
                                $.post('chat-script.php', {fnct: 'sendMessage', otherId: alreadySelectedUser, message: msgToSend}, function(data){
                                    $('#msgZone').val('');
                                });
                        });
                    }

                    $('.user-li').on('click', function(){
                        // Display discussion
                        $('#inputZone').removeAttr('hidden');
                        
                        selectedUser = $(this);
                        $('.user-li').each(function(){
                            $(this).css('background-color', '#fff');
                        });

                        selectedUser.css('background-color', '#eee');
                        userId = selectedUser.attr('id');
                        $('#selectedUserId').val(userId);
                        getMessages(userId);
                    });
                });
            }, 1000);
        });

        function getMessages(userId){
            $.get('chat-script.php', {fnct: 'getMessages', otherId: userId}, function(data){
                $('#displayMsg').empty();
                messages = JSON.parse(data);
                messages.forEach(msg => {
                    if(msg.sender_id == userId)
                        $('#displayMsg').append('<div class="bulle-receive">'+msg.contenu+'</div>');
                    else
                        $('#displayMsg').append('<div class="bulle-send">'+msg.contenu+'</div>');
                });
                $('#discussion').scrollTop($('#discussion').prop("scrollHeight") - $('#discussion').prop("clientHeight"));
            });
        }
    </script>
</body>
</html>