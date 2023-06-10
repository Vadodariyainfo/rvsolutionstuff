<?php

use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TutorialController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\FrontSettingsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\StorageFileController;

// front
use App\Http\Controllers\Front\TutorialController as FrontTutorial;
use App\Http\Controllers\Front\FrontHomeController;
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

Route::get('database/backup', function () {

    \Artisan::call('databaseBackup:cron');

    dd("databaseBackup:cron");

});
Route::get('ipget', function () {
$log = array(
  'ip' => $_SERVER['REMOTE_ADDR'],
  // 're' => $_SERVER['HTTP_REFERER'],
  'ag' => $_SERVER['HTTP_USER_AGENT'],
  'ts' => date("Y-m-d h:i:s",time())
);

echo json_encode($log);
});
Route::get('clear', function () {
    \Artisan::call('cache:clear');
    dd("clear cache");
});

Auth::routes(['register' => false]);
// google login
// Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('image/asset/file/{folder}/{file}', [StorageFileController::class, 'getImageAssetStorgeFile'])->name('image.asset.storage.file');

//FrontHomeController
Route::get('/', [FrontHomeController::class, 'index'])->name('front.home');
Route::get('dvsolution', [FrontHomeController::class, 'index'])->name('dvsolution.front.home');
Route::get('blog/{slug}', [FrontHomeController::class, 'blogDetail'])->name('blog.detail');
Route::get('categories', [FrontHomeController::class, 'categories'])->name('blog.categories');
Route::get('blog/category/{slug}', [FrontHomeController::class, 'blogCat'])->name('blog.cat');
Route::get('latestpost', [FrontHomeController::class, 'latestPost'])->name('latest.post');
Route::get('disclaimer', [FrontHomeController::class, 'disclaimer'])->name('blog.disclaimer');
Route::get('privacy-policy', [FrontHomeController::class, 'privacypolicy'])->name('blog.privacypolicy');
Route::get('about-us', [FrontHomeController::class, 'aboutus'])->name('blog.aboutus');

Route::get('snippet', [FrontHomeController::class, 'snipestPostIndex'])->name('snippet');
Route::get('snippet/{slug}', [FrontHomeController::class, 'snipestPostDetail'])->name('post.detail');

// Route::get('tagslist', [FrontHomeController::class, 'taglist'])->name('taglist');
// Route::get('tag/{slug}', [FrontHomeController::class, 'tagPages'])->name('tag.pages');


Route::get('contact-us', [FrontHomeController::class, 'contactus'])->name('blog.contactus');
Route::post('contact-us/store', [FrontHomeController::class, 'contactusStore'])->name('blog.contactus.store');

Route::post('subscribe/store', [FrontHomeController::class, 'subscriberStore'])->name('subscriber.store');

//Tutorial
Route::get('free-tutorials', [FrontTutorial::class, 'index'])->name('tutorial');
Route::get('tutorials/{languageSlug}/{tutorialSlug}', [FrontTutorial::class, 'tutorialDetails'])->name('tutorialDetails');

Route::group(['prefix' => 'admin','middleware' => 'is-admin'], function () {
    
    //dashboardController
    Route::get('dashboard', [DashBoardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    //UserController
    Route::resource('users', UserController::class);
    Route::post('user/change-status/{id}', [UserController::class, 'userChangeStatus'])->name('users.change.status');
    
    //CategoryController
    Route::resource('categorys', CategoryController::class);
    
    //TagController
    Route::resource('tags', TagController::class);
    
    //LanguageController
    Route::resource('languages', LanguageController::class);
    
    //LanguageController
    Route::resource('tutorials', TutorialController::class);

    // ContactController
    Route::resource('contactus',ContactController::class);
    Route::get('contactus/replay/{id}', [ContactController::class, 'contactusReplay'])->name('contactus.replay');
    Route::Post('contactus/replay/send', [ContactController::class, 'contactusReplaySend'])->name('contactus.replay.send');
    Route::delete('contact/truncate', [ContactController::class, 'contactusTrunct'])->name('contact.truncate');

    //BlogController
    Route::resource('blogs', BlogController::class);

    Route::get('blogs/related-blogs/{id}', [BlogController::class, 'relatedBlogs'])->name('admin.related.blogs');
    Route::post('blogs/related-blogs/store', [BlogController::class, 'relatedBlogStore'])->name('admin.related.blog.store');
    Route::post('blog/change-status/{id}', [BlogController::class, 'blogChangeStatus'])->name('blog.change.status');
    
    // ImageController
    Route::get('image/create', [ImageController::class, 'create'])->name('image.create');
    Route::post('image/store', [ImageController::class, 'Store'])->name('image.store');

    //PostController
    Route::resource('posts', PostController::class);
    Route::get('post/tag/{id}', [PostController::class, 'createTag'])->name('post.tag.create');
    Route::post('post/tag/store', [PostController::class, 'addTag'])->name('post.tag.store');
    Route::get('post/clear/cache/{slug}', [PostController::class, 'postClearCache'])->name('post.clear.cache');

    // TagController
    Route::get('update-post', [TagsController::class, 'index'])->name('update.post');
    Route::post('tags/store', [TagsController::class, 'store'])->name('tag.store');
    Route::post('getAjaxPost', [TagsController::class, 'getAjaxPost'])->name('getajax.post.data');

    // admin update
    Route::get('user-profile', [ProfileController::class, 'profile'])->name('admin.profile');
    Route::post('user-profile-update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');

    // subscriber update
    Route::get('subscriber', [SubscriberController::class, 'index'])->name('admin.subscriber.index');
    Route::delete('subscriber-destroy/{subscriber}', [SubscriberController::class, 'delete'])->name('admin.subscriber.destroy');

    Route::get('backup', [BackupController::class, 'backup'])->name('database.backup.index');
    Route::get('backup/store', [BackupController::class, 'store'])->name('admin.backup.store');
     Route::get('backup/download', [BackupController::class, 'download'])->name('admin.backup.download');
    Route::get('backup/media/store', [BackupController::class, 'storeMedia'])->name('admin.media.backup.store');
    Route::get('backup/media/download', [BackupController::class, 'mediaDownload'])->name('admin.media.backup.download');

    Route::get('post/publish', [BlogController::class, 'postPublish'])->name('admin.post.publish');
    //FrontSettingsController
    Route::get('settings', [FrontSettingsController::class, 'index'])->name('front.settings');
    Route::post('settingsUpdate', [FrontSettingsController::class, 'update'])->name('front.settings.update');
});
//Route::get('admin/backup/download', [BackupController::class, 'download'])->name('admin.backup.download');
Route::group(['middleware' => ['auth'],'prefix' => 'user'], function () {
    
    //dashboardController
    Route::get('dashboard', [DashBoardController::class, 'userDashboard'])->name('user.admin.dashboard');

    // admin update
    Route::get('auth-users-profile', [ProfileController::class, 'profile'])->name('user.admin.profile');
    Route::post('auth-users-profile-update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');

    //BlogController
    Route::get('auth/blog', [UserBlogController::class, 'index'])->name('auth.blog.index');
    Route::get('auth/blog/create', [UserBlogController::class, 'create'])->name('auth.blog.create');
    Route::post('auth/blog', [UserBlogController::class, 'store'])->name('auth.blog.store');
    Route::get('auth/blog/{blog}/edit', [UserBlogController::class, 'edit'])->name('auth.blog.edit');
    Route::put('auth/blog/{blog}', [UserBlogController::class, 'update'])->name('auth.blog.update');
    Route::delete('auth/blog/{blog}', [UserBlogController::class, 'destroy'])->name('auth.blog.destroy');
    Route::get('auth/blogs/related-blogs/{id}', [UserBlogController::class, 'relatedBlogs'])->name('auth.blog.related.blog');
    Route::post('auth/blogs/related-blogs/store', [UserBlogController::class, 'relatedBlogStore'])->name('auth.blog.related.blog.store');
    
    // ImageController
    Route::get('auth/image/create', [ImageController::class, 'create'])->name('auth.user.image.create');
    Route::post('auth/image/store', [ImageController::class, 'Store'])->name('auth.user.image.store');
});

Route::get('sitemap.xml', [FrontHomeController::class, 'siteMap'])->name('sitemap');

Route::get('rss', function(){
    $posts = App\Models\Blog::orderBy('blogs.id', 'desc')->get();
    $frontsetting = App\Models\FrontSetting::pluck('value','slug');
    $content = view("dvSolutionFront.rssFeed",compact('posts','frontsetting'));
    return Response::make($content, '200')->header('Content-Type', 'text/xml');
});

// Route::get('ads.txt', function(){
//     return view('ads');
// });

// Route::get('blog-record', function(){
//     // $blog = App\Models\Blog::onlyTrashed()->get();
//     App\Models\Blog::withTrashed()->restore();
//     dd("Record Successfully Retrive.");
// });

// Route::any('{query}', 
//   function() { return redirect(route('front.home')); })
//   ->where('query', '.*');