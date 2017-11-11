<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1'], function () {
        Route::get('status', 'IndexController@status');
	    Route::get('/page', 'PageController@index');
	    // Page
	    Route::post('/page/subscribed', 'PageController@subscribed');
	    Route::post('/page/unSubscribed', 'PageController@unSubscribed');

        Route::get('categories', 'CategoryController@index');

        Route::post('signup', 'AuthController@postSignUp');
        Route::post('signin', 'AuthController@postSignIn');
        Route::post('token/refresh', 'AuthController@refreshToken');

        Route::post('signin/facebook', 'FacebookAuthController@facebookSignIn');
        Route::post('forgot-password', 'PasswordController@forgotPassword');

	    Route::group(['middleware' => 'api.client'], function () {

	    	//province
		    Route::get('provinces', 'ProvinceController@index');
		    Route::get('provinces/{id}', 'ProvinceController@show');
		    Route::get('provinces/ngay-quay/{date}', 'ProvinceController@getProvinceOpen');
            Route::get('getAppHeader', 'XAppHeaderController@getAppHeader');
            Route::get('userPoint', 'UserPointController@index');

		    // ket qua
		    Route::get('ketQuaMienBac', 'KetquaMienbacController@index');
		    Route::get('ketQuaMienBac/{id}/', 'KetquaMienbacController@show');
		    Route::get('ketQuaMienBac/ngay-quay/{date}/', 'KetquaMienbacController@showByDate');
		    Route::post('ketQuaMienBac/do-so', 'KetquaMienbacController@checkResult');

		    Route::get('ketQuaMienNam', 'KetquaMiennamController@index');
		    Route::get('ketQuaMienNam/{id}/', 'KetquaMiennamController@show');
		    Route::get('ketQuaMienNam/ngay-quay/{date}/', 'KetquaMiennamController@showByDate');
		    Route::post('ketQuaMienNam/do-so', 'KetquaMiennamController@checkResult');

		    Route::get('ketQuaMienTrung', 'KetquaMientrungController@index');
		    Route::get('ketQuaMienTrung/{id}/', 'KetquaMientrungController@show');
		    Route::get('ketQuaMienTrung/ngay-quay/{date}/', 'KetquaMientrungController@showByDate');
		    Route::post('ketQuaMienTrung/do-so', 'KetquaMientrungController@checkResult');

		    Route::get('ketQuaMega645', 'KetquaMega645Controller@index');
		    Route::get('ketQuaMega645/{id}/', 'KetquaMega645Controller@show');
		    Route::get('ketQuaMega645/ngay-quay/{date}/', 'KetquaMega645Controller@showByDate');

		    Route::get('ketQuaMax4d', 'KetquaMax4dController@index');
		    Route::get('ketQuaMax4d/{id}/', 'KetquaMax4dController@show');
		    Route::get('ketQuaMax4d/ngay-quay/{date}/', 'KetquaMax4dController@showByDate');

		    Route::get('ketQuaThanTai', 'KetquaThantaiController@index');
		    Route::get('ketQuaThanTai/{id}/', 'KetquaThantaiController@show');
		    Route::get('ketQuaThanTai/ngay-quay/{date}/', 'KetquaThantaiController@showByDate');

		    Route::get('ketQuaDienToan123', 'KetquaDientoan123Controller@index');
		    Route::get('ketQuaDienToan123/{id}/', 'KetquaDientoan123Controller@show');
		    Route::get('ketQuaDienToan123/ngay-quay/{date}/', 'KetquaDientoan123Controller@showByDate');

		    Route::get('ketQuaDienToan6x36', 'KetquaDientoan6x36Controller@index');
		    Route::get('ketQuaDienToan6x36/{id}/', 'KetquaDientoan6x36Controller@show');
		    Route::get('ketQuaDienToan6x36/ngay-quay/{date}/', 'KetquaDientoan6x36Controller@showByDate');
            Route::post('doSo', 'KetQuaController@checkResult');
            Route::get('ketQua', 'KetQuaController@index');

		    // thong ke
		    Route::group(['prefix' => 'thongKe'], function () {
			    Route::get('/', 'ThongkeLotoController@index');
			    Route::get('boSoRaNhieu', 'ThongkeLotoController@getBoSoRaNhieu');
			    Route::get('boSoRaIt', 'ThongkeLotoController@getBoSoRaIt');
			    Route::get('dauSo', 'ThongkeLotoController@getDauSo');
			    Route::get('ditSo', 'ThongkeLotoController@getDitSo');
			    Route::get('lotoGan', 'ThongkeLotoController@getBoSoGan');
			    Route::get('dauSoDangBang', 'ThongkeLotoController@getDauSoDangBang');
			    Route::get('ditSoDangBang', 'ThongkeLotoController@getDitSoDangBang');
			    Route::get('boSoKep', 'ThongkeLotoController@getBoSoKep');
			    Route::get('boSoSatKep', 'ThongkeLotoController@getBoSoSatKep');
			    Route::get('boSoChanLe', 'ThongkeLotoController@getBoSoChanLe');
			    Route::get('boSoLeChan', 'ThongkeLotoController@getBoSoLeChan');
			    Route::get('boSoChanChan', 'ThongkeLotoController@getBoSoChanChan');
			    Route::get('boSoLeLe', 'ThongkeLotoController@getBoSoLeLe');
			    Route::get('boSoTongChan', 'ThongkeLotoController@getBoSoTongChan');
			    Route::get('boSoTongLe', 'ThongkeLotoController@getBoSoTongLe');

			    Route::get('lotoGanCucDai', 'ThongkeLotoGanCucdaiController@index');
			    Route::get('lotoDenky', 'ThongkeLotoDenkyController@index');
			    Route::get('chuKyBoSo', 'ThongkeChukyBosoController@index');
			    Route::get('boSoVeLienTiep', 'ThongkeBosoVeLientiepController@index');
			    Route::get('giaiDacBiet', 'KetQuaController@getGiaiDacBiet');
		    });
	     });

        Route::get('chot', 'ChotController@index');

        Route::group(['middleware' => 'api.auth'], function () {
	        Route::post('/page/subscribed', 'PageController@subscribed');
	        Route::post('/page/unSubscribed', 'PageController@unSubscribed');

	        # customer
	        Route::get('/customer', 'CustomerController@index');
	        Route::get('/customer/{id}', 'CustomerController@show');
	        Route::post('/customer/conversation', 'CustomerController@conversations');
	        Route::post('/customer', 'CustomerController@store');
			#feed
	        Route::post('/feed/pullFeed', 'FeedController@pullFeed');
	        Route::get('/feed', 'FeedController@index');
	        Route::post('/feed', 'FeedController@store');
	        Route::post('/feed/delete/{id}', 'FeedController@destroy');
	        Route::post('/feed/{id}', 'FeedController@update');
			#custom field customer
	        Route::get('/field/{page_id}', 'CustomerCustomFieldController@index');
	        Route::post('/field', 'CustomerCustomFieldController@store');
	        Route::post('/field/{id}', 'CustomerCustomFieldController@update');
	        Route::delete('/field/{id}', 'CustomerCustomFieldController@destroy');
			#Tag
	        Route::get('/tag/{page_id}', 'TagController@index');
	        Route::post('/tag', 'TagController@store');
	        Route::post('/tag/{id}', 'TagController@update');
	        Route::delete('/tag/{id}', 'TagController@destroy');
	        Route::post('/customer/{customer_id}/tag/{tag_id}', 'TagController@tag');
	        Route::delete('/customer/{customer_id}/tag/{tag_id}', 'TagController@removeTag');

            Route::post('signout', 'AuthController@postSignOut');
			// ME
	        Route::group(['prefix' => 'me'], function () {
		        Route::get('/', 'MeController@getMe');
		        Route::put('/', 'MeController@updateMe');
		        Route::get('groups', 'MyGroupController@index');
		        Route::post('groups/{id}/favorite', 'MyGroupController@addFavorite');
		        Route::delete('groups/{id}/favorite', 'MyGroupController@deleteFavorite');
		        Route::get('groups/invitations', 'MyGroupInvitationController@index');
		        Route::get('groups/invitations/{id}/accept', 'MyGroupInvitationController@accept');
		        Route::get('groups/invitations/{id}/reject', 'MyGroupInvitationController@reject');
		        Route::resource('interests', 'MyInterestController');

		        Route::post('devices', 'MeController@addDevice');
	        });



	        Route::get('events/{id}/attendees', 'EventController@attendees');
            Route::post('events/{id}/bookings', 'EventController@book');

            Route::resource('events', 'EventController', ['only' => [
                'index', 'show', 'store',
            ]]);

            Route::post('groups/{id}/invite', 'GroupController@invite');
            Route::get('groups/{id}/members', 'GroupController@members');
            Route::get('groups/{id}/events', 'GroupController@events');
            Route::get('groups/{id}/join', 'GroupController@join');
            Route::get('groups/{id}/leave', 'GroupController@leave');

            Route::get('groups/{id}/requests', 'GroupRequestController@index');
            Route::post('groups/{id}/requests', 'GroupRequestController@store');
            Route::delete('groups/{id}/requests/{userId}', 'GroupRequestController@destroy');

            Route::post('groups/{id}/requests/{userId}/approve', 'GroupRequestController@approve');
            Route::post('groups/{id}/requests/{userId}/reject', 'GroupRequestController@reject');

            Route::post('groups/{id}/messages', 'MessageController@send');

            Route::resource('groups', 'GroupController', ['except' => [
                'create', 'edit',
            ]]);


            Route::post('file/upload', 'FileController@upload');
            Route::post('chot', 'ChotController@store');
        });
    });
});
