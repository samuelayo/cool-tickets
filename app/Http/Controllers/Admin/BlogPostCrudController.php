<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BlogPostRequest as StoreRequest;
use App\Http\Requests\BlogPostRequest as UpdateRequest;

class BlogPostCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\BlogPost');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blogpost');
        $this->crud->setEntityNameStrings('blogpost', 'blog_posts');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */  
        $this->crud->setFromDb();

        

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');
        $this->crud->addField([ // image
        'label' => "Logo",
        'name' => "image",
        'type' => 'image',
        'upload' => true,
        'crop' => true, // set to true to allow cropping, false to disable
        'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
        $this->crud->addField([   // CKEditor
        'name' => 'content',
        'label' => 'Content',
        'type' => 'ckeditor'
        ]);
        $this->crud->addField([   // CKEditor
        'name' => 'keypoints',
        'label' => 'Keypoints',
        'type' => 'ckeditor'
        ]);
        $this->crud->addField([
        'name' => 'user_id',
        'type' => 'hidden',
        'value' => auth()->user()->id
        ]);
        // $this->crud->addField([
        // 'name' => 'view_count',
        // 'type' => 'text',
        // 'value' => 0
        // ]);

        $this->crud->addField([  // Select
                                'label' => "Category",
                                'type' => 'select',
                                'name' => 'category', // the db column for the foreign key
                                'entity' => 'blogpost', // the method that defines the relationship in your Model
                                'attribute' => 'name', // foreign key attribute that is shown to user
                                'model' => "App\Models\Category" // foreign key model
                                ], 
                                'update/create/both');
        $this->crud->addField([ // select_from_array
    'name' => 'published',
    'label' => "Status",
    'type' => 'select_from_array',
    'options' => ['0' => 'Draft', '1' => 'Publish'],
    'allows_null' => false,
    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
]);
        $this->crud->addField([   // DateTime
    'name' => 'schedule',
    'label' => 'Schedule Post',
    'type' => 'datetime_picker',
    // optional:
    'datetime_picker_options' => [
        'format' => 'DD/MM/YYYY HH:mm',
        'language' => 'en'
    ]
]);
  

 $this->crud->addField([   // DateTime
    'name' => 'promoted',
    'label' => 'Promote?',
    'type' => 'select_from_array',
    'options' => ['0' => 'No', '1' => 'Yes'],
    'allows_null' => false,
]);

      $this->crud->addFields([
[ // image
                'label' => "Extra Images",
                'name' => "extra_images",
                'type' => 'image_multiple',
                'upload' => true,
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1.8, // ommit or set to 0 to allow any aspect ratio
            ]
]);
$this->crud->addColumn('created_at');
//
  $this->crud->addColumn(
[
   // run a function on the CRUD model and show its return value
   'name' => "category name",
   'label' => "Blog Category", // Table column heading
   'type' => "model_function",
   'function_name' => 'get_cat', // the method in your Model
]
  );

//   $this->crud->removeColumn(['label'=>'Category']);
// $this->crud->setColumnDetails('category',
//  [
//    // 1-n relationship
//    'label' => "Category", // Table column heading
//    'type' => "select",
//    'name' => 'category', // the column that contains the ID of that connected entity;
//    'entity' => 'blogposts', // the method that defines the relationship in your Model
//    'attribute' => "id", // foreign key attribute that is shown to user
//    'model' => "\App\Models\Category::class", // foreign key model
// ]
// ); 

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
         $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    // public function store(StoreRequest $request)
    // {
    //     // your additional operations before save here
    //     $redirect_location = parent::storeCrud();
    //     // your additional operations after save here
    //     // use $this->data['entry'] or $this->crud->entry
    //     return $redirect_location;
    // }

    public function store(StoreRequest $request)
	{
        // Setup storage
        $attribute_name = "extra_images";
        $disk = "uploads";
        $destination_path = "/uploads/uploads";
	    // Then get images from request
	    $input = $request->all();
	    $images = $input[$attribute_name];
	    $imageArray = [];
	    // Now iterate images
        foreach ($images as $value) {
            // Store on disk and add to array
            if (starts_with($value, 'data:image'))
            {
                // 0. Make the image
                $image = \Image::make($value);
                // 1. Generate a filename.
                $filename = md5($value.time()).'.jpg';
                // 2. Store the image on disk.
                \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
                // 3. Save the path to the database
                array_push($imageArray, $destination_path.'/'.$filename);
            }
        }
        // Update $request with new array
        $request->request->set($attribute_name, json_encode($imageArray));

		// Save $request
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
	}

    // public function update(UpdateRequest $request)
    // {
    //     // your additional operations before save here
    //     $redirect_location = parent::updateCrud();
    //     // your additional operations after save here
    //     // use $this->data['entry'] or $this->crud->entry
    //     return $redirect_location;
    // }

    public function update(UpdateRequest $request)
	{
        // Setup storage
        $attribute_name = "extra_images";
        $disk = "uploads";
        $destination_path = "/uploads/uploads";
        // Then get images from request
        $input = $request->all();
        if(array_key_exists($attribute_name,$input)){
            $images = $input[$attribute_name];
        }else{
            $images = [];
        }
        
        $imageArray = [];
        // Now iterate images
        foreach ($images as $value) {
            // Store on disk and add to array
            if (starts_with($value, 'data:image'))
            {
                // 0. Make the image
                $image = \Image::make($value);
                // 1. Generate a filename.
                $filename = md5($value.time()).'.jpg';
                // 2. Store the image on disk.
                \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
                // 3. Save the path to the database
                array_push($imageArray, $destination_path.'/'.$filename);
            } else {
                $value = substr($value, 9);
                array_push($imageArray, $value);
            }
        }
        // Update $request with new array
        $request->request->set($attribute_name, json_encode($imageArray));
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
	}
}
