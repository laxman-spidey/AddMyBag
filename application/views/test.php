<!DOCTYPE html>
<html ng-app="AddMyBag">
    <head>
        <title>AddMyBag</title>
        <script type="text/javascript" src="Scripts/plugins/Angular/angular.min.js"></script>
        <script type="text/javascript" src="Scripts/plugins/Angular/angular-route.js"></script>
        <script type="text/javascript" src="Scripts/app/app.js"></script>
        <script type="text/javascript" src="Scripts/app/controllers/TestController.js"></script>
        <script type="text/javascript" src="Scripts/app/services/testService.js"></script>
        
    </head>
    <body ng-controller="testController">
        {{testVar}}
        <br/>
        <?php echo base_url("index.php/admin/do_search"); ?>
    </body>
</html>