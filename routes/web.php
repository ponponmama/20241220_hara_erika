// 商品関連（メインページを兼ねる）
Route::get('/products', 'ProductController@index');              // 商品一覧（トップページ）
Route::get('/products/{productId}', 'ProductController@show');   // 商品詳細
Route::post('/products/{productId}/update', 'ProductController@update'); // 商品更新
Route::get('/products/register', 'ProductController@create');    // 商品登録フォーム
Route::post('/products/register', 'ProductController@store');    // 商品登録処理
Route::get('/products/search', 'ProductController@search');      // 検索
Route::delete('/products/{productId}/delete', 'ProductController@destroy'); // 削除

// シーズン関連
Route::resource('seasons', 'SeasonController');  
Route::post('/products/{productId}/seasons', 'ProductSeasonController@attach');