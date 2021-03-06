<?php

Route::post('/api/init', ['uses'=>'ApisController@postInit']);
Route::post('/api/check-token', ['uses'=>'ApisController@postCheckToken']);
Route::post('/api/login', ['uses'=>'ApisController@postLogin']);
Route::post('/api/fblogin', ['uses'=>'ApisController@postFBLogin']);
Route::post('/api/search-02', ['uses' => 'ApisController@postUpdateAds']);
Route::post('/api/search-02loc', ['uses' => 'ApisController@postUpdateAdsLoc']);
Route::post('/api/ads-req-map', ['uses' => 'ApisController@postViewAdsOnMap']);
Route::post('/api/prepare-ad',  ['uses' => 'ApisController@postPrepareAds']);
Route::post('/api/e_prepare-ad',  ['uses' => 'ApisController@postE_PrepareAds']);
Route::post('/api/get-more-adds',  ['uses' => 'ApisController@postMoreAds']);
Route::get('/api/appurlhandler/{id}',  ['uses' => 'ApisController@getAppUrlHandler']);
//facebook comments
Route::get('/api/fbcomment/{id}/{actkn}',  ['uses' => 'ApisController@getFBComments']);
//facebook comments
Route::post('/api/post-comment',  ['uses' => 'ApisController@postPostComment']);
Route::post('/api/del-comment',  ['uses' => 'ApisController@postDelComment']);
Route::post('/api/load-ads',  ['uses' => 'ApisController@postLoadAds']);
Route::post('/api/load-ads-profile',  ['uses' => 'ApisController@postLoadAdsProfile']);
Route::post('/api/view-profile-ads',  ['uses' => 'ApisController@postViewProfileAds']);
Route::post('/api/get-profile-info',  ['uses' => 'ApisController@postProfileInfo']);
Route::post('/api/get-followpage-data',  ['uses' => 'ApisController@postgetFollowPageData']);
Route::post('/api/upload-profile-image', ['uses'=>'ApisController@postProfileChangeImage']);
Route::post('/api/delete-post', ['uses'=>'ApisController@postDeletePost']);
Route::post('/api/follow-user', ['uses'=>'ApisController@postFollowUser']);
Route::post('/api/unfollow-user', ['uses'=>'ApisController@postUnFollowUser']);



Route::group(['middleware' => 'beforeFilter'], function () {
	Route::post('/api/process-qkpost', ['uses'=>'ApisController@postQkpst']);
	Route::post('/api/e-process-qkpost', ['uses'=>'ApisController@postEQkpst']);
	Route::get('/api/dashboard/{tkn}', ['uses' => 'DashboardsController@getIndexApi']);
	Route::post('/api/upload-ads-tmp', ['uses'=>'ApisController@postAdsImageTmp']);
	Route::post('/api/users/validate', ['uses'=>'ApisController@postValidate']);
	Route::post('/api/users/register', ['uses'=>'ApisController@postRegistration']);
	Route::post('/api/save-rate', ['uses'=>'ApisController@postSaveRate']);
});


//CHAT ROUTES
Route::post('/g-m', ['as'=>'g_m','uses'=>'ConversationsController@postRtrnMsgs']);
Route::post('/rqst-s-time', ['as'=>'r_st','uses'=>'HomeController@postRtrnSrvrTime']);
Route::post('/data-update', ['as'=>'chat-send','uses'=>'ConversationsController@postSaveChatMessage']);
Route::post('get-adds', ['as'=>'get_adds', 'uses' => 'AdsController@getGetAds']);
Route::post('sendmessage', ['as'=>'sendmessage', 'uses' => 'HomeController@sendMessage']);
Route::get('writemessage', 'HomeController@writemessage');
//CHAT ROUTES END

Route::group(['middleware' => 'beforeFilter'], function () {
	Route::get('/update-messages', ['as'=>'chat', 'uses' => 'HomeController@getUpdateMessages']);	
	Route::post('/search-01', ['as'=>'search-01', 'uses' => 'AdsController@postSearchByText']);
	Route::post('/search-02', ['as'=>'search-02', 'uses' => 'AdsController@postSearchByCategory']);
	Route::post('/search-03', ['as'=>'search-03', 'uses' => 'AdsController@postSearchByCity']);
	//to open individual ad, this route is used to open ads from facebook or for comments
	Route::get('/posts/{id}', ['as'=>'popup-post', 'uses' => 'HomeController@getPopUpPost']);

	//ONLY AUTH
	Route::group(['middleware' => 'only.auth'], function () {
		//CHAT ROUTES
		Route::post('/save-rate', ['uses'=>'AdsController@postSaveRate']);
		Route::post('/process-qkpost', ['as'=>'qkpost-process','uses'=>'AdsController@postQkpst']);
		Route::post('/store-wishlist', ['as'=>'store_wishlist','uses'=>'AdsController@postStoreAd']);
		Route::post('/remove-wishlist',  ['as'=>'remove-wishlist', 'uses' => 'AdsController@postRemoveWishlist']);
		//Dashboard
		Route::get('/dashboard', ['as'=>'users_dash', 'uses' => 'DashboardsController@getIndex']);
		//PROFILE
		Route::get('/dashboard/profile', ['as'=>'dash_view_profile', 'uses' => 'DashboardsController@getViewProfile']);
		Route::get('/dashboard/profile-edit/{id}',  ['as' => 'edit-profile','uses' => 'DashboardsController@getProfileEdit', function ($id) {}]);
		Route::post('/dashboard/profile-edit',  ['as' => 'profile-edit-post','uses' => 'DashboardsController@postProfileEdit']);
		Route::post('/users/send-file', ['uses'=>'UsersController@postSendFile']);

		//POSTS
		Route::get('/dashboard/all-posts', ['as'=>'dash_view_posts', 'uses' => 'DashboardsController@getPostsIndex']);
		Route::get('/dashboard/posts-edit/{id}',  ['as' => 'edit-post','uses' => 'AdsController@getPostsEdit', function ($id) {}]);
		Route::post('/dashboard/posts-edit',  ['as' => 'posts-edit','uses' => 'AdsController@postPostsEdit']);
		Route::get('/dashboard/posts-remove/{id}',  ['as' => 'remove-post','uses' => 'AdsController@getPostsRemove', function ($id) {}]);
		// Post AD
		Route::post('/upload-ads-tmp', ['as'=>'post-ads-image','uses'=>'AdsController@postAdsImageTmp']);
	});

	//HOME ROUTE
	Route::get('/', ['as'=>'home_index', 'uses' => 'HomeController@getHomePage']);
	Route::get('/home', ['as'=>'home_index', 'uses' => 'HomeController@getHomePage']);
	Route::get('/m', ['as'=>'home_m', 'uses' => 'HomeController@getHomePageM']);
	// Route::get('/home', ['as'=>'home_index', 'uses' => 'HomeController@getHomepage']);

	// WEBSITE PUBLIC PAGES
	Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');
	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');


	Route::get('registration', ['as'=>'registration_view','uses'=>'UsersController@getRegistration']);
	Route::post('registration', ['uses'=>'UsersController@postRegistration']);
	Route::post('users/return-users',  ['uses' => 'UsersController@postReturnUsers', 'middleware' => ['acl:admins/acl/view']]);
	Route::post('users/invoice-users',  ['uses' => 'UsersController@postInvoiceUsers', 'middleware' => ['acl:admins/acl/view']]);
	Route::post('users/user-info',  ['uses' => 'UsersController@postUserInfo', 'middleware' => ['acl:admins/acl/view']]);
	Route::post('/prepare-ad',  ['uses' => 'AdsController@postPrepareAds']);
	Route::get('/verify-email/{id}',  ['as'=>'verify_mail', 'uses' => 'UsersController@getEmailVerify']);

	Route::group(['prefix' => 'users'], function () {
		Route::get('get-content',['uses'=>'UsersController@getGetContent']);

		Route::get('login', ['as'=>'users_login','uses'=>'UsersController@getLogin']);
		Route::post('login',['uses'=>'UsersController@postLogin']);
		Route::post('login-invoices',['uses'=>'InvoicesController@postLoginInvoices']);
		Route::post('login-modal', ['uses'=>'UsersController@postLoginModal']);
		Route::get('profile/{username}',  ['as'=>'users_profile','uses' => 'UsersController@getProfile', function ($username) {}]);
		Route::post('profile',  ['as'=>'users_profile_post','uses' => 'UsersController@postProfile']);
		Route::post('user-auth', ['uses'=>'UsersController@postUserAuth']);
		Route::post('validate', ['uses'=>'UsersController@postValidate']);
		Route::get('logout', ['as'=>'users_logout','uses'=>'UsersController@getLogout']);
		Route::post('auth-check', ['as'=>'users_ac','uses'=>'UsersController@postUsersAuthCheck']);
		Route::post('auth-check-review', ['as'=>'users_ac_review','uses'=>'UsersController@postUsersAuthCheckReview']);
	});	
	Route::group(['prefix' => 'admins'], function () {
		Route::get('login', ['as'=>'admin_login', 'uses' => 'AdminsController@getLogin']);
		Route::post('login', 'AdminsController@postLogin');
		Route::get('logout', 'AdminsController@getLogout');			
	});


			/** ADMINS ACL GROUP **/
	Route::group(['middleware' => ['auth']], function(){
		Route::get('admins',  ['as'=>'admins_index', 'uses' => 'AdminsController@getIndex', 'middleware' => ['acl:admins']]);
			
		Route::group(['prefix' => 'admins'], function () {
			$prefix = 'admins';	
			Route::get('roles',  ['as'=>'roles_index', 'uses' => 'RolesController@getIndex', 'middleware' => ['acl:'.$prefix.'/roles']]);
			Route::get('roles/add',  ['as'=>'roles_add', 'uses' => 'RolesController@getAdd','middleware' => ['acl:'.$prefix.'/roles/add']]);
			Route::post('roles/add',  ['uses' => 'RolesController@postAdd', 'middleware' => ['acl:'.$prefix.'/roles/add']]);
			Route::get('roles/edit/{id}',  ['as'=>'roles_edit', 'uses' => 'RolesController@getEdit', 'middleware' => ['acl:'.$prefix.'/roles/edit/{id}'], function ($id) {}]);
			Route::post('roles/edit',  ['as'=>'roles_update','uses' => 'RolesController@postEdit', 'middleware' => ['acl:'.$prefix.'/roles/edit']]);
			Route::get('roles/delete-data/{id}',  ['as'=>'roles_delete', 'uses' => 'RolesController@getDelete', 'middleware' => ['acl:'.$prefix.'/roles/delete-data{id}'], function ($id) {}]);

			Route::get('permissions',  ['as'=>'permissions_index', 'uses' => 'PermissionsController@getIndex', 'middleware' => ['acl:'.$prefix.'/permissions']]);
			Route::get('permissions/add',  ['as'=>'permissions_add','uses' => 'PermissionsController@getAdd', 'middleware' => ['acl:'.$prefix.'/permissions/add']]);
			Route::post('permissions/add',  ['uses' => 'PermissionsController@postAdd', 'middleware' => ['acl:'.$prefix.'/permissions/add']]);
			Route::get('permissions/edit/{id}', ['as' => 'permissions_edit', 'uses' => 'PermissionsController@getEdit','middleware' => ['acl:'.$prefix.'/permissions/edit/{id}'], function ($id) {}]);
			Route::post('permissions/edit',  ['uses' => 'PermissionsController@postEdit', 'middleware' => ['acl:'.$prefix.'/permissions/edit']]);
			Route::get('permissions/delete-data/{id}',  ['as'=>'permissions_delete','uses' => 'PermissionsController@getDelete', 'middleware' => ['acl:'.$prefix.'/permissions/delete-data{id}'], function ($id) {}]);

			Route::get('permission-roles',  ['as'=>'permission_roles_index', 'uses' => 'PermissionRolesController@getIndex', 'middleware' => ['acl:'.$prefix.'/permission-roles']]);
			Route::get('permission-roles/add',  ['as'=>'permission_roles_add', 'uses' => 'PermissionRolesController@getAdd', 'middleware' => ['acl:'.$prefix.'/permission-roles/add']]);
			Route::post('permission-roles/add',  ['uses' => 'PermissionRolesController@postAdd', 'middleware' => ['acl:'.$prefix.'/permission-roles/add']]);
			Route::get('permission-roles/edit/{id}',  ['as'=>'permission_roles_edit', 'uses' => 'PermissionRolesController@getEdit', 'middleware' => ['acl:'.$prefix.'/permission-roles/edit/{id}'], function ($id) {}]);
			Route::post('permission-roles/edit',  ['uses' => 'PermissionRolesController@postEdit', 'middleware' => ['acl:'.$prefix.'/permission-roles/edit']]);
			Route::get('permission-roles/delete-data/{id}',  ['as'=>'permission_roles_delete', 'uses' => 'PermissionRolesController@getDelete', 'middleware' => ['acl:'.$prefix.'/permission-roles/delete-data/{id}'], function ($id) {}]);

			//WEBSITE BRAND
			Route::get('website-brand/index',  ['as' => 'website_brand_index','uses' => 'WebsiteBrandController@getIndex', 'middleware' => ['acl:'.$prefix.'/website-brand/index']]);
			Route::post('website-brand/index',  ['uses' => 'WebsiteBrandController@postIndex', 'middleware' => ['acl:'.$prefix.'/website-brand/index']]);
			Route::post('website-brand/upload',  ['uses' => 'WebsiteBrandController@postUpload', 'middleware' => ['acl:'.$prefix.'/website-brand/upload']]);


			Route::get('acl/view',  ['as' => 'acl_view','uses' => 'AdminsController@getViewAcl', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			
			//PAGES
			Route::get('pages',  ['as' => 'pages_index','uses' => 'PagesController@getIndex', 'middleware' => ['acl:'.$prefix.'/pages']]);
			Route::get('pages/sliders-index',  ['as' => 'sliders_index','uses' => 'PagesController@getSlidersIndex', 'middleware' => ['acl:'.$prefix.'/pages/sliders-index']]);
			Route::get('pages/sliders-add',  ['as' => 'sliders_add','uses' => 'PagesController@getSlidersAdd', 'middleware' => ['acl:'.$prefix.'/pages/sliders-add']]);
			Route::post('pages/sliders-add',  ['uses' => 'PagesController@postSlidersAdd', 'middleware' => ['acl:'.$prefix.'/pages/sliders-add']]);
			Route::get('pages/sliders-edit/{id}',  ['as' => 'sliders_edit','uses' => 'PagesController@getSlidersEdit', 'middleware' => ['acl:'.$prefix.'/pages/sliders-edit'], function ($id) {}]);
			Route::post('pages/sliders-edit',  ['uses' => 'PagesController@postSlidersEdit', 'middleware' => ['acl:'.$prefix.'/pages/sliders-edit']]);
			Route::get('pages/add',  ['as' => 'pages_add','uses' => 'PagesController@getAdd', 'middleware' => ['acl:'.$prefix.'/pages/add']]);
			Route::post('pages/preview',  ['uses' => 'PagesController@postAddPreviewStep', 'middleware' => ['acl:'.$prefix.'/pages/preview']]);
			Route::post('pages/preview2',  ['uses' => 'PagesController@postAddPreviewStep2', 'middleware' => ['acl:'.$prefix.'/pages/preview2']]);
			Route::post('pages/edit-preview',  ['uses' => 'PagesController@postEditPreviewStep', 'middleware' => ['acl:'.$prefix.'/pages/edit-preview']]);
			Route::post('pages/sort',  ['uses' => 'PagesController@postAddSortStep', 'middleware' => ['acl:'.$prefix.'/pages/sort']]);
			Route::post('pages/data',  ['uses' => 'PagesController@postAddDataStep', 'middleware' => ['acl:'.$prefix.'/pages/data']]);
			Route::post('pages/add',  ['uses' => 'PagesController@postAdd', 'middleware' => ['acl:'.$prefix.'/pages/add']]);
			Route::post('pages/add-data',  ['uses' => 'PagesController@postAddData', 'middleware' => ['acl:'.$prefix.'/pages/add-data']]);
			Route::post('pages/data-edit',  ['uses' => 'PagesController@postEditDataStep', 'middleware' => ['acl:'.$prefix.'/pages/data-edit']]);
			Route::post('pages/add-section',  ['uses' => 'PagesController@postAddSection', 'middleware' => ['acl:'.$prefix.'/pages/add-section']]);
			Route::post('pages/add-section-edit',  ['uses' => 'PagesController@postAddSectionEdit', 'middleware' => ['acl:'.$prefix.'/pages/add-section-edit']]);
			Route::get('pages/edit/{id}',  ['as' => 'pages_edit','uses' => 'PagesController@getEdit', 'middleware' => ['acl:'.$prefix.'/pages/edit'], function ($id) {}]);
			Route::post('pages/edit',  ['uses' => 'PagesController@postEdit', 'middleware' => ['acl:'.$prefix.'/pages/edit']]);
			Route::post('pages/remove',  ['uses' => 'PagesController@postRemove', 'middleware' => ['acl:'.$prefix.'/pages/remove']]);
			Route::get('pages/remove/{id}',  ['as' => 'pages_remove','uses' => 'PagesController@getRemove', 'middleware' => ['acl:'.$prefix.'/pages/remove'], function ($id) {}]);
			Route::post('pages/sliders/upload',  ['uses' => 'PagesController@postUploadSlider', 'middleware' => ['acl:'.$prefix.'/pages/sliders/upload']]);
			Route::post('pages/pages-slider/upload',  ['uses' => 'PagesController@postUploadPagesSliderImage', 'middleware' => ['acl:'.$prefix.'/pages/pages-slider/upload']]);
			Route::post('pages/pages-image/upload',  ['uses' => 'PagesController@postUploadPagesImageSingle', 'middleware' => ['acl:'.$prefix.'/pages/pages-image/upload']]);
			Route::get('pages/view/{id}',  ['as' => 'pages_view','uses' => 'PagesController@getView', 'middleware' => ['acl:'.$prefix.'/pages/view'], function ($id) {}]);
			Route::post('pages/view',  ['uses' => 'PagesController@postView', 'middleware' => ['acl:'.$prefix.'/pages/view']]);
			

			Route::get('users/index',  ['as' => 'users_index','uses' => 'AdminsController@getUsersIndex', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::get('users/add',  ['as' => 'users_add','uses' => 'AdminsController@getUsersAdd', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::post('users/add',  ['uses' => 'AdminsController@postUsersAdd', 'middleware' => ['acl:'.$prefix.'/acl/view']]);
			Route::get('users/edit/{id}',  ['as' => 'users_edit','uses' => 'AdminsController@getUsersEdit', 'middleware' => ['acl:'.$prefix.'/acl/view'], function ($id) {}]);
			Route::post('users/edit',  ['uses' => 'AdminsController@postUsersEdit', 'middleware' => ['acl:'.$prefix.'/acl/view']]);

		});
	});

	//PERMISSIONS ROUTE
	Route::group(['prefix' => 'permissions'], function () {
		Route::get('auto-update', ['uses'=>'PermissionsController@getAutoUpdate']);
	});

	//HOME ROUTE
	Route::get('/', ['as'=>'home_index', 'uses' => 'HomeController@getHomepage']);

});