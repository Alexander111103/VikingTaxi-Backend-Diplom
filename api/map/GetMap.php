<?php 
    if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
    {
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="map/html; charset=utf-8"/>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=a36cde6b-2202-41e4-ac57-34889ffb135f&suggest_apikey=8d505c91-3825-4543-9d6a-3fd3c38c4d40" type="text/javascript"></script>
        <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <style> 
            html, body, #map, #upperlayer { 
                width: 100%; 
                height: 100%; 
                padding: 0; 
                margin: 0; 
                box-sizing: border-box; 
                z-index: 0;
                left: 0;
                top: 0;
                position: absolute;
            }
            body{
                position: relative;
            }
            #upperlayer{
                z-index: 1;
                pointer-events: none;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            #round{
                width: 100px;
                height: 100px;
                background: radial-gradient(circle at 50%, #00000000 35%, rgba(33, 150, 243, 0.5));
                border-radius: 50px;
                animation: search 4s ease-in-out infinite;
            }
            @keyframes search{
                from{
                    transform: scale(1);
                    opacity: 0;
                }
                20%{
                    opacity: 1;
                }
                90%{
                    opacity: 0;
                }
                to{
                    transform: scale(4);
                    opacity: 0;
                }
            }
            .hidden{
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
        <div id="upperlayer"><div id="round" class="hidden"></div></div>
    </body>
</html>
<script>
    var routeInfo = {};
    var myMap;
    var functionNow = "no";

    var StartPlacemark;
    var FinishPlacemark;
    var timeWaitingDriver;
    var multiRouteView;
    var WaitingPlacemark;

    ymaps.ready(function () {
    myMap = new ymaps.Map('map', { center: [56.843994, 53.252093], zoom: 13, controls: [] }, { restrictMapArea: [[55.843994,52.252093],[57.843994,54.252093]]});

    var routePanelControl = new ymaps.control.RoutePanel({
        options: {
            showHeader: true,
            title: 'Маршрут',
            routePanelTypes: {taxi: false},
            maxWidth: '300px'
        }
    });

    myMap.events.add('balloonopen', function(){
        myMap.balloon.close();
    });

    myMap.behaviors.disable('rightMouseButtonMagnifier');

    routePanelControl.routePanel.state.set({type: "auto", toEnabled: true});

    myMap.controls.add(routePanelControl);

        var multiRoutePromise = routePanelControl.routePanel.getRouteAsync();

        multiRoutePromise.then(function (multiRoute) {

            multiRoute.model.setParams({results: 1, reverseGeocoding: true, boundedBy: [[55.843994,52.252093],[57.843994,54.252093]], strictBounds: true});
            
            multiRoute.events.add('balloonopen', function(){
                multiRoute.getActiveRoute().balloon.close();
            });

            multiRoute.model.events.add('requestsuccess', function () {
                var activeRoute = multiRoute.getActiveRoute();
                var wayPoints = multiRoute.getWayPoints();
                if (activeRoute) {
                    routeInfo.distance = activeRoute.properties.get("distance").text;
                    routeInfo.duration = activeRoute.properties.get("duration").text;
                    routeInfo.durationInTraffic = activeRoute.properties.get("durationInTraffic").text;
                    routeInfo.startShort = "" + wayPoints.get(1).properties.get("name");
                    routeInfo.finishShort = "" + wayPoints.get(0).properties.get("name");
                    routeInfo.startLong = "" + wayPoints.get(1).properties.get("address");
                    routeInfo.finishLong = "" + wayPoints.get(0).properties.get("address");
                    routeInfo.startCoorders = "" + wayPoints.get(1).properties.get("request");
                    routeInfo.finishCoorders = "" + wayPoints.get(0).properties.get("request");
                }
                else
                {
                    routeInfo.distance = "";
                    routeInfo.duration = "";
                    routeInfo.durationInTraffic = "";
                    routeInfo.startShort = "";
                    routeInfo.finishShort = "";
                    routeInfo.startLong = "";
                    routeInfo.finishLong = "";
                    routeInfo.startCoorders = "";
                    routeInfo.finishCoorders = "";
                }
            });
            multiRoute.options.set({
                wayPointStartIconFillColor: "red",
                wayPointFinishIconFillColor: "red",
                routeActiveStrokeColor: "#2196F3"
            });  
        });
    });

    window.addEventListener('load', async () => 
    {
        await delay(300);
        
        switch(GetCookie("State"))
        {
            case "Order":
                if(GetCookie("CoordersFrom") != "" && GetCookie("CoordersTo") != "")
                {
                    ReRoute(GetCookie("CoordersFrom"), GetCookie("CoordersTo"));
                }
                break;

            case "Search":
                RemoveRouteBilder();
                SearchView(GetCookie("CoordersFrom"));
                break;

            case "Waiting":
                RemoveRouteBilder();
                TaxiDriverGoToUser(GetCookie("CoordersFrom"), GetCookie("CoordersTo"));
                break;

            case "WaitingUser":
                RemoveRouteBilder();
                WaitingUserView(GetCookie("CoordersTo"), GetCookie("CoordersFrom"));
                break;

            case "Drive":
                RemoveRouteBilder();
                TaxiDriverDrive(GetCookie("CoordersFrom"), GetCookie("CoordersTo"));
                break;
        }
    });

    function GetRouteInfo()
    {
        let json = JSON.stringify(routeInfo);

        if(routeInfo.distance != null)
        {
            myMap.controls.get(0).routePanel.options.set({allowSwitch: false});
            myMap.controls.get(0).routePanel.state.set({ toEnabled: false, fromEnabled: false });
        }

        return json;
    }

    function EditRoute()
    {
        if(routeInfo.distance != null)
        {
            myMap.controls.get(0).routePanel.options.set({allowSwitch: true});
            myMap.controls.get(0).routePanel.state.set({toEnabled: true, fromEnabled: true});
        }
    }

    function SetFromAddress(_from)
    {
        myMap.controls.get(0).routePanel.state.set({ from: _from });
    }

    function SetToAddress(_to)
    {
        myMap.controls.get(0).routePanel.state.set({ to: _to });
    }
    
    function ReRoute(_from, _to)
    {
        myMap.controls.get(0).routePanel.state.set({ toEnabled: false, fromEnabled: false });
        myMap.controls.get(0).routePanel.options.set({ allowSwitch: false });
        myMap.controls.get(0).routePanel.state.set({ from: _from, to: _to });
    }

    function RemoveRouteBilder()
    {
        myMap.controls.remove(myMap.controls.get(0));
    }

    function TaxiDriverGoToUser(start, finish)
    {
            if(GetCookie("State") == "Waiting")
            {
                functionNow = "waiting";
                
                StopAnimationSearch();

                RemoveTaxiDriverGoToUserOnMap();
                
                OnZoomAndMove();
                
                var StartCoorders = start.replace(' ', '').split(',');
                var FinishCoorders = finish.replace(' ', '').split(',');

                var multiRouteModel = new ymaps.multiRouter.MultiRouteModel([start, finish]);
                multiRouteView = new ymaps.multiRouter.MultiRoute(multiRouteModel, { boundsAutoApply: true });

                myMap.geoObjects.add(multiRouteView);

                multiRouteView.model.setParams({ results: 1 });
                multiRouteView.options.set({ wayPointVisible: false, routeActiveStrokeColor: "#2196F3" });

                multiRouteView.events.add('balloonopen', function () {
                    multiRouteView.getActiveRoute().balloon.close();
                });
                
                multiRouteView.model.events.add("requestsuccess", function ()
                {
                    var activeRoute = multiRouteView.getActiveRoute();

                    timeWaitingDriver = activeRoute.properties.get("durationInTraffic").text;
                    
                    StartPlacemark = new ymaps.Placemark([StartCoorders[0], StartCoorders[1]], { iconContent: '<img src="http://taxiviking.ru/api/map/media/taxiOnMap.png" width="75" height="50" id="car"><style>#car{position:absolute; left: -20px; top: -8px;}</style>' }, { hasBalloon: false, hasHint: false });
                    myMap.geoObjects.add(StartPlacemark);
                    
                    FinishPlacemark = new ymaps.Placemark([FinishCoorders[0], FinishCoorders[1]], { iconContent: timeWaitingDriver }, { preset: 'islands#blackStretchyIcon', hasBalloon: false, hasHint: false });
                    myMap.geoObjects.add(FinishPlacemark);
                });
            }
            else
            {
                location. reload();
            }
    }

    function TaxiDriverDrive(start, finish)
    {
            if(GetCookie("State") == "Drive")
            {
                functionNow = "Drive";

                RemoveTaxiDriverGoToUserOnMap();
                
                OnZoomAndMove();
                
                var StartCoorders = start.replace(' ', '').split(',');
                var FinishCoorders = finish.replace(' ', '').split(',');

                var multiRouteModel = new ymaps.multiRouter.MultiRouteModel([start, finish]);
                multiRouteView = new ymaps.multiRouter.MultiRoute(multiRouteModel, { boundsAutoApply: true });

                myMap.geoObjects.add(multiRouteView);

                multiRouteView.model.setParams({ results: 1 });
                multiRouteView.options.set({ wayPointVisible: false, routeActiveStrokeColor: "#2196F3" });

                multiRouteView.events.add('balloonopen', function () {
                    multiRouteView.getActiveRoute().balloon.close();
                });
                
                multiRouteView.model.events.add("requestsuccess", function ()
                {
                    StartPlacemark = new ymaps.Placemark([StartCoorders[0], StartCoorders[1]], { iconContent: '<img src="http://taxiviking.ru/api/map/media/taxiOnMap.png" width="75" height="50" id="car"><style>#car{position:absolute; left: -20px; top: -8px;}</style>' }, { hasBalloon: false, hasHint: false });
                    myMap.geoObjects.add(StartPlacemark);
                    
                    FinishPlacemark = new ymaps.Placemark([FinishCoorders[0], FinishCoorders[1]], { }, { preset: 'islands#blackDotIcon', hasBalloon: false, hasHint: false });
                    myMap.geoObjects.add(FinishPlacemark);
                });
            }
            else
            {
                location. reload();
            }
    }

    function RemoveTaxiDriverGoToUserOnMap()
    {
        if (StartPlacemark != null || FinishPlacemark != null) 
        {
            myMap.geoObjects.remove(StartPlacemark);
            myMap.geoObjects.remove(FinishPlacemark);
            myMap.geoObjects.remove(multiRouteView);
        }
    }

    function RemoveSearchView()
    {
        if (WaitingPlacemark != null) 
        {
            myMap.geoObjects.remove(WaitingPlacemark);
        }
    }

    function GetTimeWaitingDriver()
    {
        return timeWaitingDriver;
    }

    function WaitingUserView(pointUser, pointCar)
    {
        RemoveTaxiDriverGoToUserOnMap();

        SearchView(pointUser);
        StopAnimationSearch();
        
        var StartCoorders = pointCar.replace(' ', '').split(',');

        StartPlacemark = new ymaps.Placemark([StartCoorders[0], StartCoorders[1]], { iconContent: '<img src="http://taxiviking.ru/api/map/media/taxiOnMap.png" width="75" height="50" id="car"><style>#car{position:absolute; left: -20px; top: -8px;}</style>' }, { hasBalloon: false, hasHint: false });
        myMap.geoObjects.add(StartPlacemark);

        functionNow = "waitingUser";
    }

    function SearchView(point)
    {
        RemoveSearchView();

        Coorders = point.replace(' ', '').split(',');
        WaitingPlacemark = new ymaps.Placemark([Coorders[0], Coorders[1]], {},  { preset: 'islands#blackDotIcon', hasBalloon: false, hasHint: false });
        myMap.geoObjects.add(WaitingPlacemark);

        OffZoomAndMove();
        myMap.setCenter([Coorders[0], Coorders[1]]);
        myMap.setZoom(15, {duration:3000});
        
        StartAnimationSearch();

        functionNow = "search";
    }

    function SearchViewOnce(point)
    {
        if(functionNow != "search")
        {
            SearchView(point);
        }
    }

    function StartAnimationSearch()
    {
        var round = document.getElementById("round");
        round.classList.remove("hidden");
    }

    function StopAnimationSearch()
    {
        var round = document.getElementById("round");
        round.classList.add("hidden");
    }

    function OffZoomAndMove()
    {
        myMap.behaviors.disable('scrollZoom');
        myMap.behaviors.disable('drag');
        myMap.behaviors.disable('dblClickZoom');
        myMap.behaviors.disable('multiTouch');
    }

    function OnZoomAndMove()
    {
        myMap.behaviors.enable('scrollZoom');
        myMap.behaviors.enable('drag');
        myMap.behaviors.enable('dblClickZoom');
        myMap.behaviors.enable('multiTouch');
    }

    function GetCookie(name)
    {
        var cookies = document.cookie.split(";");

        for (let i = 0; i < cookies.length; i++) 
        {
            if(cookies[i].trim(' ').split("=")[0] == name)
            {
                return cookies[i].trim(' ').split("=")[1].replace("%2C", ",");
            }
        }
    }

    function SetCookie(name, value)
    {
        document.cookie = name.trim(' ') + "=" + value.trim(' ');
    }

    const delay = async (ms) => await new Promise(resolve => setTimeout(resolve, ms));

</script>

<?php
    }
?>