<?php
use App\Http\Controllers\LanguageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

    // Dashboard Route
Route::get('/', 'DashboardController@dashboardModern')->name('home');
Route::get('/modern', 'DashboardController@dashboardModern');
Route::get('/ecommerce', 'DashboardController@dashboardEcommerce');
Route::get('/analytics', 'DashboardController@dashboardAnalytics');


// Notifications Route

Route::get('/markAsRead/{noti}', 'NotificationsController@markAsRead')->name('mark');


// Calendar Route

Route::get('/app-calendar', 'CalendarController@index');
Route::get('/app-calendar/populate', 'CalendarController@index');
Route::post('/app-calendar/store', 'CalendarController@store');



// Contacts Route

Route::get('app-contacts', 'ContactController@index')->middleware('permissions:list-contact')->name('list.contact');
Route::get('app-contacts/{id}', 'ContactController@show')->middleware('permissions:view-contact')->name('view.contact');
Route::post('app-contacts/store', 'ContactController@store')->middleware('permissions:add-contact')->name('store.contact');
Route::get('app-contacts-edit/{id}', 'ContactController@edit')->middleware('permissions:edit-contact')->name('edit.contact');
Route::post('app-contacts-edit/update', 'ContactController@update')->middleware('permissions:edit-contact')->name('update.contact');
Route::get('app-contacts-list/delete/{id}', 'ContactController@destroy')->middleware('permissions:delete-contact')->name('delete.contact');
Route::get('app-contacts-list/restore/{id}', 'ContactController@restore')->middleware('permissions:restore-contact')->name('restore.contact');
Route::post('ajax/getcity', 'ContactController@getCities');
Route::post('ajax/getdistrict', 'ContactController@getDistricts');


// Leads Route

Route::post('ajax/getboards', 'LeadStageController@index');
Route::post('ajax/changeStage', 'LeadController@changeStage');
Route::get('app-leads-list', 'LeadController@index')->middleware('permissions:list-lead')->name('list.lead');
Route::get('app-leads-view/{id}', 'LeadController@show')->middleware('permissions:view-lead')->name('view.lead');
Route::get('app-leads-add', 'LeadController@create')->middleware('permissions:add-lead')->name('add.lead');
Route::get('app-leads-convert/{id}', 'LeadController@convertToLead')->middleware('permissions:add-lead')->name('convert.lead');
Route::post('app-leads-add/store', 'LeadController@store')->middleware('permissions:add-lead')->name('store.lead');
Route::get('app-leads-edit/{id}', 'LeadController@edit')->middleware('permissions:edit-lead')->name('edit.lead');
Route::post('app-leads-edit/update/{id}', 'LeadController@update')->middleware('permissions:edit-lead')->name('update.lead');
Route::post('app-leads-view/delete/{lead}', 'LeadController@destroy')->middleware('permissions:delete-lead')->name('delete.lead');
Route::get('app-leads-view/won/{id}', 'LeadController@wonLead')->middleware('permissions:edit-lead')->name('won.lead');
Route::get('app-leads-view/lost/{id}', 'LeadController@lostLead')->middleware('permissions:edit-lead')->name('lost.lead');


// Qualified Leads Route

Route::get('app-qualified-lead', 'QualifiedLeadController@index')->middleware('permissions:list-qualified-leads')->name('list.qualified-leads');

// Projects Route

Route::get('app-projects-list', 'ProjectController@index')->middleware('permissions:list-project')->name('list.project');
Route::get('app-projects-view/{project}', 'ProjectController@show')->middleware('permissions:list-project')->name('view.project');
Route::get('app-projects-add', 'ProjectController@create')->middleware('permissions:add-project')->name('add.project');
Route::post('app-projects-add/store', 'ProjectController@store')->middleware('permissions:add-project')->name('store.project');
Route::get('app-projects-edit/{project}', 'ProjectController@edit')->middleware('permissions:edit-project')->name('edit.project');
Route::post('app-projects-edit/update/{project}', 'ProjectController@update')->middleware('permissions:edit-project')->name('update.project');
Route::post('app-projects/delete/{project}', 'ProjectController@destroy')->middleware('permissions:delete-project')->name('delete.project');

// Stages Route

Route::get('app-stages-all', 'BuildingGroupController@index')->middleware('permissions:list-stage')->name('all.stages');
Route::get('app-projects-view/{project}/add', 'BuildingGroupController@create')->middleware('permissions:add-stage')->name('add.projectStage');
Route::post('app-projects-view/{project}/store', 'BuildingGroupController@store')->middleware('permissions:add-stage')->name('store.projectStage');
Route::get('app-projects-view/{project}/{stage}', 'BuildingGroupController@show')->middleware('permissions:view-stage')->name('view.projectStage');
Route::get('app-stages-edit/{stage}', 'BuildingGroupController@edit')->middleware('permissions:edit-stage')->name('edit.projectStage');
Route::post('app-stages-edit/update/{stage}', 'BuildingGroupController@update')->middleware('permissions:edit-stage')->name('update.projectStage');
Route::post('app-stages-view/delete/{stage}', 'BuildingGroupController@destroy')->middleware('permissions:delete-stage')->name('delete.projectStage');
Route::get('app-stages-list', 'ProjectController@index')->middleware('permissions:list-stage')->name('list.stage');

// Buildings Route

Route::get('app-buildings-all', 'BuildingController@index')->middleware('permissions:list-building')->name('all.buildings');
Route::get('app-buildings-add/{stage}/add', 'BuildingController@create')->middleware('permissions:add-building')->name('add.buildingToStage');
Route::post('app-buildings-add/{stage}/store', 'BuildingController@store')->middleware('permissions:add-building')->name('store.buildingToStage');
Route::get('app-buildings-view/{building}', 'PropertyController@index')->middleware('permissions:view-building')->name('view.building');
Route::get('app-buildings-edit/{building}', 'BuildingController@edit')->middleware('permissions:edit-building')->name('edit.building');
Route::post('app-building-edit/update/{building}', 'BuildingController@update')->middleware('permissions:edit-building')->name('update.building');
Route::post('app-building-view/delete/{building}', 'BuildingController@destroy')->middleware('permissions:delete-building')->name('delete.building');

// Properties Route

Route::get('app-properties-all', 'PropertyController@allProps')->middleware('permissions:list-property')->name('all.properties');
Route::get('app-properties-add/{building}/add', 'PropertyController@create')->middleware('permissions:add-property')->name('add.buildingProperty');
Route::post('app-properties-add/{building}/store', 'PropertyController@store')->middleware('permissions:add-property')->name('store.buildingProperty');
Route::get('app-properties/sell/{property}', 'PropertyController@sell')->middleware('permissions:sell-property')->name('sell.property');
Route::get('app-properties/delete/{property}', 'PropertyController@destroy')->middleware('permissions:delete-property')->name('delete.property');
Route::post('app-properties/hold/{property}', 'PropertyController@hold')->middleware('permissions:hold-property')->name('hold.property');
Route::get('app-properties/release/{property}', 'PropertyController@release')->middleware('permissions:release-property')->name('release.property');


//  Deals Route

Route::post('ajax/changeDealStage', 'DealController@changeDealStage');
Route::get('app-deals-list', 'DealController@index')->middleware('permissions:list-deal')->name('list.deal');
Route::get('app-deals-add/{property}', 'DealController@create')->middleware('permissions:add-deal')->name('add.deal');
Route::post('app-deals-add/{property}/store/', 'DealController@store')->middleware('permissions:add-deal')->name('store.deal');
Route::get('app-deals-view/{id}', 'DealController@show')->middleware('permissions:view-deal')->name('view.deal');
Route::get('app-deals-edit/{id}','DealController@edit')->middleware('permissions:edit-deal')->name('edit.deal');
Route::post('app-deals-edit/update/{id}','DealController@update')->middleware('permissions:edit-deal')->name('update.deal');
Route::get('app-deals-view/lost/{id}', 'DealController@wonDeal')->middleware('permissions:edit-deal')->name('won.deal');
Route::get('app-deals-view/delete/{id}', 'DealController@destroy')->middleware('permissions:edit-deal')->name('delete.deal');

// Comments Route
Route::post('app-leads-view/comment/store/{lead}/{user}', 'CommentController@storeLeadComment')->middleware('permissions:add-comment')->name('store.leadcomment');
Route::post('app-deals-view/comment/store/{deal}/{user}', 'CommentController@storeDealComment')->middleware('permissions:add-comment')->name('store.dealcomment');
Route::post('comment/delete/{id}', 'CommentController@deleteComment')->middleware('permissions:delete-comment')->name('delete.comment');



// Application Route
Route::get('/app-email', 'ApplicationController@emailApp');
Route::get('/app-email/content', 'ApplicationController@emailContentApp');
Route::get('/app-chat', 'ApplicationController@chatApp');
Route::get('/app-todo', 'ApplicationController@todoApp');
Route::get('/app-kanban', 'ApplicationController@kanbanApp');
Route::get('/app-file-manager', 'ApplicationController@fileManagerApp');

Route::get('/app-invoice-list', 'ApplicationController@invoiceList');
Route::get('/app-invoice-view', 'ApplicationController@invoiceView');
Route::get('/app-invoice-edit', 'ApplicationController@invoiceEdit');
Route::get('/app-invoice-add', 'ApplicationController@invoiceAdd');
Route::get('/eCommerce-products-page', 'ApplicationController@ecommerceProduct');
Route::get('/eCommerce-pricing', 'ApplicationController@eCommercePricing');

// User profile Route
Route::get('/user-profile-page', 'UserProfileController@userProfile');

// Page Route
Route::get('/page-contact', 'PageController@contactPage');
Route::get('/page-blog-list', 'PageController@pageBlogList');
Route::get('/page-search', 'PageController@searchPage');
Route::get('/page-knowledge', 'PageController@knowledgePage');
Route::get('/page-knowledge/licensing', 'PageController@knowledgeLicensingPage');
Route::get('/page-knowledge/licensing/detail', 'PageController@knowledgeLicensingPageDetails');
Route::get('/page-timeline', 'PageController@timelinePage');
Route::get('/page-faq', 'PageController@faqPage');
Route::get('/page-faq-detail', 'PageController@faqDetailsPage');
Route::get('/page-account-settings', 'PageController@accountSetting');
Route::get('/page-blank', 'PageController@blankPage');
Route::get('/page-collapse', 'PageController@collapsePage');

// Media Route
Route::get('/media-gallery-page', 'MediaController@mediaGallery');
Route::get('/media-hover-effects', 'MediaController@hoverEffect');

// User Route
Route::get('page-users-list', 'UserController@usersList')->middleware('permissions:list-user')->name('list.user');
Route::get('page-users-view/{id}', 'UserController@usersView')->middleware('permissions:list-user')->name('view.user');
Route::get('page-users-add', 'UserController@create')->middleware('permissions:add-user')->name('add.user');
Route::post('page-users-add/store', 'UserController@store')->middleware('permissions:add-user')->name('store.user');
Route::get('page-users-edit/{user}', 'UserController@usersEdit')->middleware('permissions:edit-user')->name('edit.user');
Route::post('page-users-edit/imageUpdate', 'UserController@usersImageUpdate')->middleware('permissions:edit-user')->name('updateImage.user');
Route::post('page-users-edit/updateOthers', 'UserController@usersUpdateOthers')->middleware('permissions:edit-user')->name('updateOthers.user');
Route::post('page-users-edit/update', 'UserController@usersUpdate')->middleware('permissions:edit-user')->name('update.user');
Route::get('page-users-list/delete/{id}', 'UserController@destroy')->middleware('permissions:delete-user')->name('delete.user');
Route::get('page-users-list/restore/{id}', 'UserController@restore')->middleware('permissions:restore-user')->name('restore.user');


// Roles Route
Route::get('page-roles-list', 'RoleController@index')->middleware('permissions:list-role')->name('list.role');
Route::get('page-roles-add', 'RoleController@create')->middleware('permissions:add-role')->name('add.role');
Route::post('page-roles-add/store', 'RoleController@store')->middleware('permissions:add-role')->name('store.role');
Route::get('page-roles-edit/{id}', 'RoleController@edit')->middleware('permissions:edit-role')->name('edit.role');
Route::post('page-roles-edit/update', 'RoleController@update')->middleware('permissions:edit-role')->name('update.role');
Route::get('page-roles-list/delete/{id}', 'RoleController@destroy')->middleware('permissions:delete-role')->name('delete.role');
Route::get('page-roles-list/restore/{id}', 'RoleController@restore')->middleware('permissions:restore-role')->name('restore.role');

// Permissions Route
Route::get('page-permissions-list', 'PermissionController@index')->middleware('permissions:list-permission')->name('list.permission');
Route::get('page-permissions-add', 'PermissionController@create')->middleware('permissions:add-permission')->name('add.permission');
Route::post('page-permissions-add/store', 'PermissionController@store')->middleware('permissions:add-permission')->name('store.permission');
Route::get('page-permissions-edit/{id}', 'PermissionController@edit')->middleware('permissions:edit-permission')->name('edit.permission');
Route::post('page-permissions-edit/update', 'PermissionController@update')->middleware('permissions:edit-permission')->name('update.permission');
Route::get('page-permissions-list/delete/{id}', 'PermissionController@destroy')->middleware('permissions:delete-permission')->name('delete.permission');
Route::get('page-permissions-list/restore/{id}', 'PermissionController@restore')->middleware('permissions:restore-permission')->name('restore.permission');


// Authentication Route
Route::get('/user-login', 'AuthenticationController@userLogin');
Route::get('/user-register', 'AuthenticationController@userRegister');
Route::get('/user-forgot-password', 'AuthenticationController@forgotPassword');
Route::get('/user-lock-screen', 'AuthenticationController@lockScreen');

// Misc Route
Route::get('/page-404', 'MiscController@page404');
Route::get('/page-maintenance', 'MiscController@maintenancePage');
Route::get('/page-500', 'MiscController@page500');

// Card Route
Route::get('/cards-basic', 'CardController@cardBasic');
Route::get('/cards-advance', 'CardController@cardAdvance');
Route::get('/cards-extended', 'CardController@cardsExtended');

// Css Route
Route::get('/css-typography', 'CssController@typographyCss');
Route::get('/css-color', 'CssController@colorCss');
Route::get('/css-grid', 'CssController@gridCss');
Route::get('/css-helpers', 'CssController@helpersCss');
Route::get('/css-media', 'CssController@mediaCss');
Route::get('/css-pulse', 'CssController@pulseCss');
Route::get('/css-sass', 'CssController@sassCss');
Route::get('/css-shadow', 'CssController@shadowCss');
Route::get('/css-animations', 'CssController@animationCss');
Route::get('/css-transitions', 'CssController@transitionCss');

// Basic Ui Route
Route::get('/ui-basic-buttons', 'BasicUiController@basicButtons');
Route::get('/ui-extended-buttons', 'BasicUiController@extendedButtons');
Route::get('/ui-icons', 'BasicUiController@iconsUI');
Route::get('/ui-alerts', 'BasicUiController@alertsUI');
Route::get('/ui-badges', 'BasicUiController@badgesUI');
Route::get('/ui-breadcrumbs', 'BasicUiController@breadcrumbsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-collections', 'BasicUiController@collectionsUI');
Route::get('/ui-navbar', 'BasicUiController@navbarUI');
Route::get('/ui-pagination', 'BasicUiController@paginationUI');
Route::get('/ui-preloader', 'BasicUiController@preloaderUI');

// Advance UI Route
Route::get('/advance-ui-carousel', 'AdvanceUiController@carouselUI');
Route::get('/advance-ui-collapsibles', 'AdvanceUiController@collapsibleUI');
Route::get('/advance-ui-toasts', 'AdvanceUiController@toastsUI');
Route::get('/advance-ui-tooltip', 'AdvanceUiController@tooltipUI');
Route::get('/advance-ui-dropdown', 'AdvanceUiController@dropdownUI');
Route::get('/advance-ui-feature-discovery', 'AdvanceUiController@discoveryFeature');
Route::get('/advance-ui-media', 'AdvanceUiController@mediaUI');
Route::get('/advance-ui-modals', 'AdvanceUiController@modalUI');
Route::get('/advance-ui-scrollspy', 'AdvanceUiController@scrollspyUI');
Route::get('/advance-ui-tabs', 'AdvanceUiController@tabsUI');
Route::get('/advance-ui-waves', 'AdvanceUiController@wavesUI');
Route::get('/fullscreen-slider-demo', 'AdvanceUiController@fullscreenSlider');

// Extra components Route
Route::get('/extra-components-range-slider', 'ExtraComponentsController@rangeSlider');
Route::get('/extra-components-sweetalert', 'ExtraComponentsController@sweetalert');
Route::get('/extra-components-nestable', 'ExtraComponentsController@nestable');
Route::get('/extra-components-treeview', 'ExtraComponentsController@treeview');
Route::get('/extra-components-ratings', 'ExtraComponentsController@ratings');
Route::get('/extra-components-tour', 'ExtraComponentsController@tour');
Route::get('/extra-components-i18n', 'ExtraComponentsController@i18n');
Route::get('/extra-components-highlight', 'ExtraComponentsController@highlight');

// Basic Tables Route
Route::get('/table-basic', 'BasicTableController@tableBasic');

// Data Table Route
Route::get('/table-data-table', 'DataTableController@dataTable');

// Form Route
Route::get('/form-elements', 'FormController@fromElement');
Route::get('/form-select2', 'FormController@formSelect2');
Route::get('/form-validation', 'FormController@formValidatation');
Route::get('/form-masks', 'FormController@masksForm');
Route::get('/form-editor', 'FormController@formEditor');
Route::get('/form-file-uploads', 'FormController@fileUploads');
Route::get('/form-layouts', 'FormController@formLayouts');
Route::get('/form-wizard', 'FormController@formWizard');

// Charts Route
Route::get('/charts-chartjs', 'ChartController@chartJs');
Route::get('/charts-chartist', 'ChartController@chartist');
Route::get('/charts-sparklines', 'ChartController@sparklines');


// locale route
Route::get('lang/{locale}',[LanguageController::class, 'swap']);


 // acess controller
 Route::get('/access-control', 'AcessController@index');
 Route::get('/access-control/{roles}', 'AcessController@roles');
 Route::get('/modern-admin', 'AcessController@home')->middleware('permissions:approve-post');




Auth::routes();

