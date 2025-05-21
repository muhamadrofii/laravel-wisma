<?php

use function Laravel\Volt\{route};
use App\Livewire\UploadCloudinary;
use App\Livewire\CloudinaryImages;
use App\Http\Controllers\XenditCallbackController;
// use App\Http\Livewire\masteruser\datauser;
// use App\Livewire\Masterusers\Index;
// use App\Livewire\User\DetailRoom;
use App\Livewire\Dashboard\PenghuniChart;

use App\Livewire\Masterusers\Index as MasterusersIndex;
use App\Livewire\Masterusers\Create as MasterusersCreate;
use App\Livewire\Masterusers\Edit as MasterusersEdit;


use App\Livewire\Masterpenginapan\Index as MasterpenginapanIndex;
use App\Livewire\Masterpenginapan\Create as MasterpenginapanCreate;
use App\Livewire\Masterpenginapan\Edit as MasterpenginapanEdit;

use App\Livewire\Masterkamar\Index as MasterkamarIndex;
use App\Livewire\Masterkamar\Create as MasterkamarCreate;
use App\Livewire\Masterkamar\Edit as MasterkamarEdit;

use App\Livewire\Masterorder\Index as MasterorderIndex;
use App\Livewire\Masterorder\Create as MasterorderCreate;
use App\Livewire\Masterorder\Edit as MasterorderEdit;
// use App\Livewire\Masterpenginapan\Index;
use App\Livewire\User\Home;
use App\Livewire\User\ListRoom;
use App\Livewire\User\DetailRoom;
use App\Livewire\User\Order;
use App\Livewire\User\ProfileUser;
use App\Livewire\User\HistoryUser;
use App\Livewire\User\ProfileForm;

// use App\Livewire\User\Index;
use App\Http\Controllers\MasteruserController;
// use App\Livewire\Masterusers;



use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// use App\Livewire\Masteruser\Datauser;

// Route::get('/datauser', Datauser::class);

// use App\Http\Livewire\Users\Diklat;

// Route::get('/', function () {
  //   return view('welcome');
  // })->name('home');

// use App\Livewire\Dashboard;

// Route::get('/dashboard', Dashboard::class)
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


  
Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified', 'role:admin'])
->name('dashboard');
  
  Route::get('/', function () {
    return view('landing');
  });
  
  // ->name('pesertadiklat');

  // Route::get('/datauser', Datauser::class)
  // ->middleware(['auth', 'verified'])
  // ->name('datauser');

  // admin
  
  // Route::middleware(['auth'])->group(function () {
  //   Route::redirect('settings', 'settings/profile');
  //   Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
  //   Volt::route('settings/password', 'settings.password')->name('settings.password');


  //   Route::get('/masterusers', MasterusersIndex::class)->name('masterusers');
  //   Route::prefix('masterusers')->name('masterusers.')->group(function () {
  //       Route::get('/create', MasterusersCreate::class)->name('create');
  //       Route::get('/edit/{id}', MasterusersEdit::class)->name('edit');
  //   });
  //   // 
  //   Route::get('/masterpenginapan', MasterpenginapanIndex::class)->name('masterpenginapan');
  //   Route::prefix('masterpenginapan')->name('masterpenginapan.')->group(function () {
  //     Route::get('/create', MasterpenginapanCreate::class)->name('create');
  //     Route::get('/edit/{id}', MasterpenginapanEdit::class)->name('edit');
  
  //     });
  //     // 
  //     Route::get('/masterkamar', MasterkamarIndex::class)->name('masterkamar');
  //     Route::prefix('masterkamar')->name('masterkamar.')->group(function () {
  //       Route::get('/create', MasterkamarCreate::class)->name('create');
  //       Route::get('/edit/{id}', MasterkamarEdit::class)->name('edit');
        
  //     });



  // });

  
Route::middleware(['auth', 'role:admin'])->group(function () {

      Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');


    Route::get('/masterusers', MasterusersIndex::class)->name('masterusers');
    Route::prefix('masterusers')->name('masterusers.')->group(function () {
        Route::get('/create', MasterusersCreate::class)->name('create');
        Route::get('/edit/{id}', MasterusersEdit::class)->name('edit');
    });
    // 
    Route::get('/masterpenginapan', MasterpenginapanIndex::class)->name('masterpenginapan');
    Route::prefix('masterpenginapan')->name('masterpenginapan.')->group(function () {
      Route::get('/create', MasterpenginapanCreate::class)->name('create');
      Route::get('/edit/{id}', MasterpenginapanEdit::class)->name('edit');
  
      });
      // 
      Route::get('/masterkamar', MasterkamarIndex::class)->name('masterkamar');
      Route::prefix('masterkamar')->name('masterkamar.')->group(function () {
        Route::get('/create', MasterkamarCreate::class)->name('create');
        Route::get('/edit/{id}', MasterkamarEdit::class)->name('edit');
        
      });

            Route::get('/masterorder', MasterorderIndex::class)->name('masterorder');
      Route::prefix('masterorder')->name('masterorder.')->group(function () {
        // Route::get('/create', MasterorderCreate::class)->name('create');
        Route::get('/edit/{orderId}', MasterorderEdit::class)->name('edit');
        
      });

});

Route::middleware(['auth', 'role:peserta,umum'])->group(function () {
          Route::get('/home', Home::class)->name('user.home');
      Route::get('/detail-room/{id}', DetailRoom::class)->name('livewire.user.detail-room');
      Route::get('/list-room', ListRoom::class)->name('livewire.user.list-room');
      Route::get('/order', Order::class)->name('livewire.user.order');
      Route::get('/profile-user', ProfileUser::class)->name('livewire.user.profile-user');
        Route::get('/history', HistoryUser::class)->name('livewire.user.history-user');
         Route::get('/profile-form', ProfileForm::class)->name('livewire.user.profile-form');
        });
        
        Route::post('/notification', [XenditCallbackController::class, 'handle']);






    
  // Route::get('/delete', Delete::class)->name('delete');
  



  
  // Route::get('/home', Home::class)->name('user.home');



  // Route::get('/detail-room/{id}', DetailRoom::class)->name('detail.room');



  // Route::prefix('masterusers')->name('masterusers.')->group(function () {
    // Route::get('/', Index::class)->name('index');    // ← ini index di dalam group
    // Route::get('/create', Create::class)->name('create');
    // Route::get('/update', Update::class)->name('update');
    // Route::get('/delete', Delete::class)->name('delete');
// });
  
Route::get('/tewst', PenghuniChart::class)->name('livewire.dashboard.penghuni-chart');

Route::get('/upload-gambar', UploadCloudinary::class);
Route::get('/cloudinary-images', CloudinaryImages::class);





// Route::get('/pesertadiklat', Diklat::class)->name('pesertadiklat');

require __DIR__ . '/auth.php';
