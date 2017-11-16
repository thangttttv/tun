<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1'], function () {
        Route::get('status', 'IndexController@status');
        Route::get('/page', 'PageController@index');

        Route::post('signup', 'AuthController@postSignUp');
        Route::post('signin', 'AuthController@postSignIn');
        Route::post('token/refresh', 'AuthController@refreshToken');

        Route::post('signin/facebook', 'FacebookAuthController@facebookSignIn');
        Route::post('forgot-password', 'PasswordController@forgotPassword');

        Route::group(['middleware' => 'api.client'], function () {
            // thong ke
        });

        Route::group(['middleware' => 'api.auth'], function () {
            Route::post('/page/subscribed', 'PageController@subscribed');
            Route::post('/page/unSubscribed', 'PageController@unSubscribed');

            // Customer
            Route::get('/page/{page_id}/customer', 'CustomerController@index');
            Route::get('/page/{page_id}/customer/{id}', 'CustomerController@show');
            Route::post('/customer/conversation', 'CustomerController@conversations');
            Route::post('/page/{page_id}/customer', 'CustomerController@store');
            //Feed
            Route::post('/feed/pullFeed', 'FeedController@pullFeed');
            Route::get('/page/{page_id}/feed', 'FeedController@index');
            Route::post('/page/{page_id}/feed', 'FeedController@store');
            Route::post('/page/{page_id}/feed/{id}', 'FeedController@update');
            Route::delete('/page/{page_id}/feed/{id}', 'FeedController@destroy');
            //Custom field customer
            Route::get('/page/{page_id}/field', 'CustomerCustomFieldController@index');
            Route::post('/page/{page_id}/field', 'CustomerCustomFieldController@store');
            Route::post('/page/{page_id}/field/{id}', 'CustomerCustomFieldController@update');
            Route::delete('/page/{page_id}/field/{id}', 'CustomerCustomFieldController@destroy');
            //Tag
            Route::get('/page/{page_id}/tag', 'TagController@index');
            Route::post('/page/{page_id}/tag', 'TagController@store');
            Route::post('/page/{page_id}/tag/{id}', 'TagController@update');
            Route::delete('/page/{page_id}/tag/{id}', 'TagController@destroy');
            Route::post('/page/{page_id}/customer/tag/{tag_id}', 'TagController@tag');
            Route::delete('/page/{page_id}/customer/tag/{tag_id}', 'TagController@removeTag');
            //Sequence
            Route::get('/page/{page_id}/sequence', 'SequenceController@index');
            Route::get('/page/{page_id}/sequence/{sequence_id}', 'SequenceController@index');
            Route::post('/page/{page_id}/sequence', 'SequenceController@store');
            Route::post('/page/{page_id}/sequence/{sequence_id}', 'SequenceController@update');
            Route::delete('/page/{page_id}/sequence/{sequence_id}', 'SequenceController@destroy');
	        Route::post('/page/{page_id}/customer/sequence/{sequence_id}', 'SequenceController@seq');
	        Route::delete('/page/{page_id}/customer/sequence/{sequence_id}', 'SequenceController@removeSequence');
            //Action
            Route::get('/action', 'ActionController@index');
            //Keyword
            Route::get('/page/{page_id}/keyword', 'KeywordController@index');
            Route::get('/page/{page_id}/keyword/{id}', 'KeywordController@show');
            Route::post('/page/{page_id}/keyword', 'KeywordController@store');
            Route::post('/page/{page_id}/keyword/{id}', 'KeywordController@update');
            Route::post('/page/{page_id}/keyword/{id}/message/{message_id}', 'KeywordController@changeMessage');
            Route::delete('/page/{page_id}/keyword/{id}/message', 'KeywordController@removeMessage');
            Route::post('/page/{page_id}/keyword/{id}/action/{action_id}', 'KeywordController@addAction');
            Route::delete('/page/{page_id}/keyword/{id}', 'KeywordController@destroy');

            Route::post('signout', 'AuthController@postSignOut');

            // ME
            Route::group(['prefix' => 'me'], function () {
                Route::get('/', 'MeController@getMe');
                Route::put('/', 'MeController@updateMe');
                Route::post('devices', 'MeController@addDevice');
            });
            Route::post('file/upload', 'FileController@upload');
        });
    });
});
