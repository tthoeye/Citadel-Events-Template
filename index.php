<?php include_once 'Config.php'; ?>
<!DOCTYPE html>
<html>
    <head> 
        <title>Events Template</title> 
        <!--------------- Metatags ------------------->   
        <meta charset="utf-8" />
        <!-- Not allowing the user to zoom -->    
        <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0"/>
        <!-- iphone-related meta tags to allow the page to be bookmarked -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <!--------------- CSS files ------------------->    
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />        
        <link rel="stylesheet" href="css/events.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" /> 
        <link rel="stylesheet" href="css/my.css" />
        <link rel="stylesheet" href="css/jquery.ui.datepicker.mobile.css" />


        <!--------------- Javascript dependencies -------------------> 
            
        <!-- Google Maps JavaScript API v3 -->    
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?sensor=false">
        </script>
        <!-- Google Maps Utility Library - Infobubble -->     
        <script type="text/javascript"
                src = "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js">
        </script>
        <!-- Overlapping markers Library: Deals with overlapping markers in Google Maps -->
        <script src="http://jawj.github.com/OverlappingMarkerSpiderfier/bin/oms.min.js"></script>  
        <!-- jQuery Library --> 
        <script src="js/jquery-1.8.2.min.js"></script>

        <script>
            //reset type=date inputs to text
            $(document).bind("mobileinit", function() {
                $.mobile.page.prototype.options.degradeInputs.date = true;
            });
        </script>


        <script src="js/jQuery.ui.datepicker.js"></script>
        <script src="js/jquery.ui.datepicker.mobile.js"></script>	

        <!-- jQuery Mobile Library -->
        <script src="js/jquery.mobile-1.2.0.min.js"></script>  
        <!-- Page params Library: Used to pass query params to embedded/internal pages of jQuery Mobile -->    
        <script src="js/jqm.page.params.js"></script>
        <!-- Template specific functions and handlers -->    
        <script src="js/events-lib.js"></script>            
     
    </head> 

    <body>
         <!-- Home Page: Contains the Map -->
        <div data-role="page" id="page1" class="page">
            <header data-role="header" data-posistion="fixed" data-id="constantNav" data-fullscreen="true">
                <span class="ui-title">Events</span>

                <!-- we use controlgroup so as to have two buttons, one for filters and one for date -->
                <div data-type="horizontal" data-role="controlgroup" class="ui-btn-left">  
                    <a href="" id="filter" data-role="button" data-icon="gear" data-iconpos="notext" data-theme="a" title="Settings">&nbsp;</a>
                    <a href="#page4" id="datefilter" data-role="button" data-icon="grid" data-iconpos="notext"  title="Search by Date">&nbsp;</a>
                </div>

                <a href="#info" data-rel="dialog" data-icon="info" data-iconpos="notext" data-theme="b" title="Info" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall ui-btn-active" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar -->
            </header>
            
            <div data-role="content" id="map-filter">
                <div class="filters-list" id="mapFilterList">
                    <fieldset data-role="controlgroup" data-mini="true" data-theme="a">
                        <!-- dynamically filled with data -->
                    </fieldset>
                </div>
                <footer data-role="footer" data-posistion="fixed" data-fullscreen="true" class="filter-footer">
                    <a href="" id="apply" data-icon="gear" data-theme="a" title="Apply" class="ui-btn-right">Apply</a>
                </footer>
            </div><!--map-filter-->

            <div data-role="content" id="map-container">
                <div id="map_canvas" class="map_canvas"></div>
            </div>
        </div>

        <!-- List Page: Contains a list with the results -->
        <div data-role="page" id="page2" class="page">

            <header data-role="header" data-posistion="fixed" data-id="constantNav">
                <span class="ui-title">Events</span>
                <fieldset data-role="controlgroup" class="favourites-button">
                    <input type="checkbox" name="favourites" id="favourites" class="custom" />
                    <label for="favourites">Favourites</label>
                </fieldset>
                <a href="" data-icon="back" data-iconpos="notext" data-theme="a" title="Back" data-rel="back" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list ui-btn-active" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar -->
            </header>

            <div class="list-container">
                <div class="list-scroll-container">
                    <div data-role="content" id="list" class="event">
                        <ul data-role='listview' data-filter='true' data-theme='b'>
                        <!-- dynamically filled with data -->
                        </ul>
                    </div><!--list-->
                </div><!--list-scroll-container-->
            </div><!--list-container-->
        </div><!-- /page -->
        
        <!-- Details Page: Contains the details of a selected element -->
        <div data-role="page" id="page3" data-title="Event Details" class="page">
            <header data-role="header" data-posistion="fixed" data-fullscreen="true">
                <span class="ui-title"> Points of Interest - Events </span>
                <a href="" data-icon="back" data-iconpos="notext" data-theme="a" title="Back" data-rel="back" class="ui-btn-right">&nbsp;</a>
                <div data-role="navbar" class="navbar">
                    <ul>
                        <li><a href="#" class="pois-nearme" data-theme="a">Near me</a></li>
                        <li><a href="#" class="pois-showall" data-theme="a">Show all</a></li>
                        <li><a href="#page2" class="pois-list" data-theme="a">List</a></li>
                    </ul>
                </div><!-- /navbar --> 
            </header>
            
            <div class="list-container">
                <div class="list-scroll-container">
                    <div data-role="content" id="item">
                        <!-- dynamically filled with data -->
                    </div><!--item-->
                </div><!--list-scroll-container-->
            </div><!--list-container-->
                
            <footer data-role="footer" data-posistion="fixed" data-fullscreen="true">
                <a href="" id="addFav" data-icon="star" data-theme="a" title="Add to favourites" data-rel="star" class="ui-btn-center">Add to favourites</a>
                <a href="" id="removeFav" data-icon="star" data-theme="a" title="Remove from favourites" data-rel="star" class="ui-btn-center">Remove from favourites</a>
            </footer>

        </div><!-- /page -->


        <!-- Details Page: Contains the details of a selected element (calendar) -->
        <div data-role="page" id="page4" data-title="Events by Date" class="page">
            <header data-role="header" data-posistion="fixed" data-fullscreen="true">
                <span class="ui-title">Show Events after the selected Date</span>
                <a href="" data-icon="back" data-iconpos="notext" data-theme="a" title="Back" data-rel="back" class="ui-btn-right">&nbsp;</a>
            </header>

            <div data-role="content" id="itemDate">
                <div class="filters-list">
                    <label id="date" for="date">Search for Events:</label>
                    <input type="date" name="date" id="date" value=""  />	
                </div>
            </div><!--item-->

            <footer data-role="footer" data-posistion="fixed" data-fullscreen="true">
                <a href="" id="dateapply" data-icon="gear" data-theme="a" title="Apply" class="ui-btn-center">Apply</a>
               
            </footer>
        </div><!-- /page -->
            
            
        <!-- Info Page: Contains info of the currently used dataset -->  
        <div data-role="page" id="info">
            <header data-role="header">
                <span class="ui-title">Dataset Metadata</span>	
            </header>
            <article data-role="content">
                <ul data-role="listview">
                    <!-- dynamically filled with data -->
                </ul> 
            </article> 
        </div> 

        <script type="text/javascript">
                    /****************** Global js vars ************************/
                    
                    /* GLobal map object */
                    var map;  
                    /* List of pois read from json object */
                    var pois = {};
                    /* List of dataset metadata read from json object */
                    var meta = {};
                    /* Holds all markers */
                    var markersArray = [];
                    /* Define filters - get them from db */
            var filters = <?php
		include_once CLASSES . 'filters.php';
		printFilters();
		?>;
                    /* Remember if a page has been opened at least once */
                    var lastLoaded = '';
                    /* Remember if 'near me' marker is loaded */
                    var isNearMeMarkerLoaded = false;
                    /* 
                     * Remember if map was initialy loaded. If not
                     * it means we loaded list page
                     */
                    var isMapLoaded = false;
                    /*
                     * Keeps page id to emulate full url using querystring
                     */
                    var pageId = 0;
                    /* Set infoBubble global variable */
                    var infoBubble;
            	    var dateIsNull=true;
                    
                    /* The coordinates of the center of the map */
                    //Issy
                    var mapLat = <?php echo MAP_CENTER_LATITUDE; ?>;
                    var mapLon = <?php echo MAP_CENTER_LONGITUDE; ?>;
					var mapZoom = <?php echo MAP_ZOOM; ?>;
                    
                    /* The url of the dataset */    
                    var datasetUrl = "<?php echo DATASET_URL; ?>";

                    /* Just call the initialization function when the page loads */
                    $(window).load(function() {
                        globalInit();
                    });     
                    
        </script>
    </body>
</html>