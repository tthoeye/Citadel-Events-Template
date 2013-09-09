Citadel-Events-Template
=======================

CITADEL on the move - Mobile application template for Events - www.citadelonthemove.eu

Deployment

1.  Put all the files under a folder named 'citadel-parkings-template' inside the web directory of your local webserver.
2.  Open the Config.php file and fill in your root web directory,e.g. (in a WAMP default installation): 

        define(“HTDOCS_ROOT”, “C:/wamp/www/”)
3.  Open a browser and point it at: http://localhost/citadel-events-template/index.php
4.  The template application is up and running with the default sample dataset.

For more details on how to install the template and the underlying technology please refer to the 
[guide documents](doc/Installation Guide-Events.docx) inside the 'doc' folder. 


Connection With UIT Databank
============================

This branch of the code contains a connector that will allow you to directly access real-time data from the Belgian
"UIT Databank".

The API is available via http://build.uitdatabank.be/api/events/
an example key to use is: 5CA9F618-1747-4EAE-ACB6-BB2D57522BE6

All data on this source is formatted using the CdbXML standard: http://www.cultuurdatabank.com/CdbXML/