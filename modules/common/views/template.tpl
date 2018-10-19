<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="library/jquery-ui.css">
        <link rel="stylesheet" href="library/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="library/jquery-timepicker/jquery.timepicker.css">
        <link rel="stylesheet" href="library/bootstrap-toggle.min.css">
        <link rel="stylesheet" href="library/spectrum.css" type="text/css" media="screen"/>
        <style>
            div {box-sizing:border-box; padding:10px;}
            .floated {float: left;}
            .box {width: 100%; position:relative}
            .menu, .content {
                width:85%; 
                box-sizing:border-box; 
                padding:10px;
            }
            .menu {
                width:15%; 
                float: left;
            }
            .clearfix {clear:both; padding:0}
            .sep {
                background-color:black;
                padding:0;
                border-width: 10px;
                position: absolute;
                left:15%;
                top:0;
                bottom:0;
                border-left: 1px dotted #ddd;
            }
            .dropdown.open {
                background: #fff;
            }
            .btn-hover-danger:hover {
                background-color: #d9534f;
            }
            #warpper
            {
                background-color: white;
                filter:alpha(opacity=50); /* IE */
                opacity: 0.5; /* Safari, Opera */
                -moz-opacity:0.50; /* FireFox */
                z-index: 20;
                height: 100%;
                width: 100%;
                background-repeat:no-repeat;
                background-position:center;
                position:absolute;
                top: 0px;
                left: 0px;
            }
            .btn-default:hover {
                color: #333;
                background-color: #e6e6e6;
                border-color: #8c8c8c;
            }
            .colorProject {
                float:left;height: 25px;padding: 1px 6px;width: 25px;border: 1px #2e6da4 solid;border-radius: 0 15px 15px 0;
            }
            .colorProject:hover {
                opacity: 0.8;
                cursor: pointer;
            }
            input[type="color"]::-webkit-color-swatch {
                border:none;
            }
            input[type="color"]::-moz-color-swatch {
                border:none;
            }
            .deleteTask:hover {
                opacity: 0.8;
                cursor: pointer;
            }
            @media screen and (max-width: 800px)
            {
                .menu {
                    width:100%;
                    float: none;
                }
                .sep {
                    opacity: 0;
                }
                
            }
        </style>
        <script type="text/javascript" src="library/jquery.js"></script>
        <script type="text/javascript" src="library/jquery-ui.js"></script>
        <script type="text/javascript" src="library/jquery-timepicker/jquery.timepicker.js"></script>
        <script type="text/javascript" src="library/bootstrap-toggle.min.js"></script>
        <script type="text/javascript" src="library/spectrum.js"></script>
    </head>
    <body>
        <div id="warpper" style="display:none"></div>
        <div class="box" style="padding:0;margin:0;">
            <div class="menu" style="height:100%;background-color:#F5F5F5;">
                <div id="display_date" style="border: 1px black dotted;text-align:center;margin-right:20px;margin-bottom: 20px;"></div>
                <ul style="list-style-type:none;">
                    <li><a href="/accueil"><span title="boîte de réception" class="glyphicon glyphicon-calendar"></span> Aujourd'hui</a></li>
                    <li><a href="/accueil"><span title="ajouter" class="glyphicon glyphicon-plus"></span> Ajouter une tâche</a></li>
                    <li><a href="/accueil"><span title="boîte de réception" class="glyphicon glyphicon-inbox"></span> Boîte de réception</a></li>
                    <li><a href="/accueil"><span title="calendrier" class="glyphicon glyphicon-calendar"></span> Calendrier</a></li>
                    <li><a href="/accueil"><span title="day" class="glyphicon glyphicon-calendar"></span> Calendrier/jour</a></li>
                    <li><a href="/logout"><span title="day" class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
                </ul>

                <div id="dialogDelete" style="display:none;"></div>

                <div class="clearfix" style="padding: 5px;"></div>

                <div class="clearfix"></div>

            </div>
            <div class="sep"></div>
            <div class="content" style="float: left;">
                {{ content|raw }} <br />
            </div>
            <div class="clearfix"></div>
        </div>
         
<script>
    $(function()
    {
        displayDate();
    });

    function displayDate()
    {
        date = new Date;
        $('#display_date').html(date.getDay() + '/' + date.getMonth() + '/' + date.getFullYear() + ' ' + date.getHours() + ':' + (date.getMinutes() < 10?'0' : '') + date.getMinutes());
        setTimeout('displayDate();', '60000');
    }
    
    //----------------------------------AJAX------------------------------------
    
    // activer/desactiver un projet
    /*function ajaxProjectsActivation(button)
    {
        var infos = button.val().split('___');
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://projetdetest.dev.s2h.corp/projectsactivation?id=' + encodeURIComponent(infos[1]));
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('readystatechange', function()
        {
            if (xhr.readyState === XMLHttpRequest.HEADERS_RECEIVED && xhr.status === 200) {
                $('#warpper').show();
            }
            if (xhr.readyState === XMLHttpRequest.DONE)
            {
                if (xhr.status === 200)
                {
                    $('#' + button.val()).hide();
                    ajaxContent();
                }
                else {
                    $('#warpper').hide();
                }
            }
        });
        xhr.send();
        
    }*/
    
    
    // Recharger le contenu (quelque soit la page
    /*function ajaxContent()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', window.location.href);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.addEventListener('readystatechange', function()
        {
            if (xhr.readyState === XMLHttpRequest.HEADERS_RECEIVED && xhr.status === 200) {
                $('#warpper').show();
            }
            if (xhr.readyState === XMLHttpRequest.DONE)
            {
                if (xhr.status === 200)
                {
                    var data = JSON.parse(xhr.responseText);
                    $('.content').html(data);
                    $('#warpper').hide();
                }
                else {
                    $('#warpper').hide();
                }
            }
        });

        xhr.send();
    }*/
</script>
    </body>
</html>