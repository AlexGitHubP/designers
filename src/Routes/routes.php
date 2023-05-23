<?php

Route::group(['middleware'=>'web'], function(){
	Route::resource('/admin/designers', 'Locomotif\Designers\Controller\DesignerController');
	Route::resource('/admin/designersAddresses', 'Locomotif\Designers\Controller\DesignersAddressesController');
});
