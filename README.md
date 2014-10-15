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
    
**Alignment**

    $model = Something::orderBy('id', 'ASC')->get();
    Cahen::align($model, 'column_name');
