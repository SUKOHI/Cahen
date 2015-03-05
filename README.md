Cahen
=====

A PHP package mainly developed for Laravel to manage order numbers of DB.

Installation&setting for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\Cahen\CahenServiceProvider',
    )

Also

    'aliases' => array(  
        ...Others...,  
        'Cahen' => 'Sukohi\Cahen\Facades\Cahen',
    )

Usage
====

**Basic moving**

    $model = Something::find(1);
    Cahen::move($model)->to('column_name', 5);

**Up**

    Cahen::move($model)->up('column_name');

**Down**

    Cahen::move($item)->down('column_name');
		
**to First**

    Cahen::move($item)->first('column_name');

**to Last**

    Cahen::move($item)->last('column_name');
    
**with Transaction**

    DB::beginTransaction();
    
    if(!Cahen::move($item)->to('column_name', 5)) {
    	
	    DB::rollback();
	
    }
    
    DB::commit();
    
    
**Where Clause**

You can sort data that has specific values.

    $model = Something::find(1);
    Cahen::move($model)
        ->where('column_1', '=', 'value')
        ->where('column_2', 'LIKE', '%value%')
        ->to('column_name', 5);

**Set data**

You can sort data in specific model data.

    $moving_id = 1;
    $model = Something::find($moving_id);
    $models = Something::where('id', '<', 5)
                ->where('id', '<>', $moving_id)
                ->get();
    Cahen::move($model)
        ->data($models)
        ->to('column_name', 3);

    * Note: You need to exclude the moving id.

**Alignment**

    $model = Something::orderBy('id', 'ASC')->get();
    Cahen::align($model, 'column_name');

License
====

This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh
