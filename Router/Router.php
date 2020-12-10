<?php

// paths
$router->get('/', function() {
    echo '<div style="text-align: center;width: 350px;margin: 50px auto;font-size: 25px;padding: 50px;box-shadow: 0 0 10px #dedede;border-radius: 5px;">
            <ul>
                <li>GET : /install - Install the database SQL </li>
                <li>PUT : /delete-hcp/:id </li>
                <li>GET : /hco-details/:id </li>
                <li>
                        POST : /search-hcp/:id 
                        <br/><u>Post Params</u><br/>
                            
                                hcp_name (string)<br/>
                                specialty (string)<br/>
                                hcp_zip (string)<br/>
                </li>
            </ul>
    </div>';
});
$router->get('/install', 'System@index');
$router->get('/hco-details/:id', 'App@hcoDetails');
$router->put('/delete-hcp/:id', 'App@deleteHcp');
$router->post('/search-hcp/:id', 'App@searchHcp');
