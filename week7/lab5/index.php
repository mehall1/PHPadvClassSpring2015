<!DOCTYPE html>
<html>
    <head>
        <title>Angular JS - Sample App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body ng-app="myApp">
        
        <div ng-view ng-cloak></div>        
        <script src="js/lib/angular.js" type="text/javascript"></script>
        <script src="js/lib/angular-route.js" type="text/javascript"></script>
        <script src="js/app.js" type="text/javascript"></script>               
        <script src="js/controllers.js" type="text/javascript"></script>   
        <script src="js/services.js" type="text/javascript"></script>   
        <script src="js/filters.js" type="text/javascript"></script>   
    </body>
</html>