
ItSolutionStuff.com

 
Home
PHP 
Javascript 
Laravel 
Tags
Demo Post
Categories
Featured Post
Laravel 6

 
Laravel 5.8 CRUD (Create Read Update Delete) Tutorial For Beginners
 By Hardik Savani |  March 11, 2019 |  | 110872 Viewer |  Category : PHP Laravel Bootstrap


 
In this step, i would like to share with you step by step tutorial of crud operation with laravel 5.8 application for beginners. you will get how to create simple insert update delete operation with laravel 5.8 from scratch. here is a simple example of laravel 5.8 crud app.

You just need to follow few step and you will get basic crud stuff using controller, model, route, bootstrap 4 and blade..

As we know just few days ago, laravel introduce it's new version of laravel 5.8. in laravel 5.8 they provide several new things that might be help you in your application. They also change directory structure for blade file.

In this tutorial, you will learn very basic crud operation with laravel new version 5.8. I am going to show you step by step from scratch so, i will better to understand if you are new in laravel.



Step 1 : Install Laravel 5.8

first of all we need to get fresh Laravel 5.8 version application using bellow command, So open your terminal OR command prompt and run bellow command:

composer create-project --prefer-dist laravel/laravel blog

Step 2: Update Database Configuration

In second step, we will make database configuration for example database name, username, password etc for our crud application of laravel 5.8. So let's open .env file and fill all details like as bellow:

.env

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=here your database name(blog)

DB_USERNAME=here database username(root)

DB_PASSWORD=here database password(root)

Step 3: Create Table

we are going to create crud application for product. so we have to create migration for "products" table using Laravel 5.8 php artisan command, so first fire bellow command:

php artisan make:migration create_products_table --create=products

After this command you will find one file in following path "database/migrations" and you have to put bellow code in your migration file for create products table.

<?php

 

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;

  

class CreateProductsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('products', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->text('detail');

            $table->timestamps();

        });

    }

  

    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('products');

    }

}

Now you have to run this migration by following command:

php artisan migrate

Step 4: Create Resource Route

Here, we need to add resource route for product crud application. so open your "routes/web.php" file and add following route.

routes/web.php

Route::resource('products','ProductController');

Step 5: Create Controller and Model

In this step, now we should create new controller as ProductController. So run bellow command and create new controller. bellow controller for create resource controller.

php artisan make:controller ProductController --resource --model=Product

After bellow command you will find new file in this path "app/Http/Controllers/ProductController.php".

In this controller will create seven methods by default as bellow methods:

1)index()

2)create()

3)store()

4)show()

5)edit()

6)update()

7)destroy()

So, let's copy bellow code and put on ProductController.php file.

app/Http/Controllers/ProductController.php

<?php

  

namespace App\Http\Controllers;

  

use App\Product;

use Illuminate\Http\Request;

  

class ProductController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $products = Product::latest()->paginate(5);

  

        return view('products.index',compact('products'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('products.create');

    }

  

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

  

        Product::create($request->all());

   

        return redirect()->route('products.index')

                        ->with('success','Product created successfully.');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show(Product $product)

    {

        return view('products.show',compact('product'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit(Product $product)

    {

        return view('products.edit',compact('product'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {

        $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

  

        $product->update($request->all());

  

        return redirect()->route('products.index')

                        ->with('success','Product updated successfully');

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();

  

        return redirect()->route('products.index')

                        ->with('success','Product deleted successfully');

    }

}


 
Ok, so after run bellow command you will find "app/Product.php" and put bellow content in Product.php file:

app/Product.php

<?php

  

namespace App;

  

use Illuminate\Database\Eloquent\Model;

   

class Product extends Model

{

    protected $fillable = [

        'name', 'detail'

    ];

}

Step 6: Create Blade Files

In last step. In this step we have to create just blade files. So mainly we have to create layout file and then create new folder "products" then create blade files of crud app. So finally you have to create following bellow blade file:

1) layout.blade.php

2) index.blade.php

3) create.blade.php

4) edit.blade.php

5) show.blade.php

So let's just create following file and put bellow code.

resources/views/products/layout.blade.php

<!DOCTYPE html>

<html>

<head>

    <title>Laravel 5.8 CRUD Application - ItSolutionStuff.com</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

</head>

<body>

  

<div class="container">

    @yield('content')

</div>

   

</body>

</html>

resources/views/products/index.blade.php

@extends('products.layout')

 

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Laravel 5.8 CRUD Example from scratch - ItSolutionStuff.com</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

   

    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Name</th>

            <th>Details</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($products as $product)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $product->name }}</td>

            <td>{{ $product->detail }}</td>

            <td>

                <form action="{{ route('products.destroy',$product->id) }}" method="POST">

   

                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>

    

                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

  

    {!! $products->links() !!}

      

@endsection

resources/views/products/create.blade.php

@extends('products.layout')

  

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Product</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

        </div>

    </div>

</div>

   

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('products.store') }}" method="POST">

    @csrf

  

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                <input type="text" name="name" class="form-control" placeholder="Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Detail:</strong>

                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

   

</form>

@endsection

resources/views/products/edit.blade.php

@extends('products.layout')

   

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Product</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

  

    <form action="{{ route('products.update',$product->id) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Detail:</strong>

                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>

   

    </form>

@endsection

resources/views/products/show.blade.php

@extends('products.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Product</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $product->name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Details:</strong>

                {{ $product->detail }}

            </div>

        </div>

    </div>

@endsection

Now we are ready to run our crud application example with laravel 5.8 so run bellow command for quick run:

php artisan serve

Now you can open bellow URL on your browser:

Read Also: Build RESTful API In Laravel 5.8 Example
http://localhost:8000/products

I hope it can help you....



Hardik Savani
My name is Hardik Savani. I'm a full-stack developer, entrepreneur and owner of Aatman Infotech. I live in India and I love to write tutorials and tips that can help to other artisan. I am a big fan of PHP, Javascript, JQuery, Laravel, Codeigniter, VueJS, AngularJS and Bootstrap from the early stage.
Follow Me: Github LinkedIn Twitter Facebook
***Do you want me hire for your Project Work? Then Contact US.

 Tags : 
CRUD
 
Example
 
Laravel
 
Laravel 5
 
Laravel 5.8
 
PHP
 
Tutorial
Featured Post

 
We are Recommending you:

How to create and download pdf in Laravel 5.8?
Ajax Autocomplete Textbox in Laravel 5.8 Example
Laravel 5.8 New Features List
Laravel 5.7 - Google Recaptcha Code with Validation
Laravel 5.7 - Generate PDF from HTML Example
Laravel 5.7 - Create REST API with authentication using Passport Tutorial
Laravel 5.7 Ajax Pagination Example
How to get last inserted id in laravel 5?
How to add ckeditor with image upload in Laravel ?
mmmmmmmmmmllimmmmmmmmmmlli


codegnitewr wordk 
phptpoint   
HTML
 
PHP
 
Mysql
 
Ajax
 
WordPress
 
Codeigniter
 
Laravel
 
Python
 
SEO
 
Json
 
Free Projects
 
Products
HomeCodeIgniter Insert Data into Database
CodeIgniter Insert Data into Database
PHP 6 Months 100% Job Assistance Program. for more info... call on 8588829328

 

 
CodeIgniter Insert Data into Database
In this tutorial, We will understand how to insert data into database using Controller model and view.
We will use users table to insert, display, update and delete.
This is users table structure

Table Name : users
user_id int primary key auto_increment
name    char(50)
email   varchar(100)
mobile  bigint
 

Connecting to a Database
In CodeIgniter, We can connect with database in 2 ways.

Automatic Connecting – Automatic Connection can be done using application/config/autoload.php
 

$autoload['libraries'] = array('database');
1
$autoload['libraries'] = array('database');
 


 
Manual Connecting – If u want database connection for some specific Controller then u can use Manual Connection.
in manual Connection u will have to Create connection for every Controller So it would be better to use Automatic Connection.
$this->load->database();
1
$this->load->database();
 

Creating a Controller
Create a new file under the path Application/controllers/Hello.php
Copy the below given code in your controllers.

<?php
class Hello extends CI_Controller 
{
    public function __construct()
    {
    //call CodeIgniter's default Constructor
    parent::__construct();
    
    //load database libray manually
    $this->load->database();
    
    //load Model
    $this->load->model('Hello_Model');
    }

    public function savedata()
    {
        //load registration view form
        $this->load->view('registration');
    
        //Check submit button 
        if($this->input->post('save'))
        {
        //get form's data and store in local varable
        $n=$this->input->post('name');
        $e=$this->input->post('email');
        $m=$this->input->post('mobile');
        
//call saverecords method of Hello_Model and pass variables as parameter
        $this->Hello_Model->saverecords($n,$e,$m);      
        echo "Records Saved Successfully";
        }
    }
}
?>
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
<?php
class Hello extends CI_Controller 
{
    public function __construct()
    {
    //call CodeIgniter's default Constructor
    parent::__construct();
    
    //load database libray manually
    $this->load->database();
    
    //load Model
    $this->load->model('Hello_Model');
    }
 
    public function savedata()
    {
        //load registration view form
        $this->load->view('registration');
    
        //Check submit button 
        if($this->input->post('save'))
        {
        //get form's data and store in local varable
        $n=$this->input->post('name');
        $e=$this->input->post('email');
        $m=$this->input->post('mobile');
        
//call saverecords method of Hello_Model and pass variables as parameter
        $this->Hello_Model->saverecords($n,$e,$m);      
        echo "Records Saved Successfully";
        }
    }
}
?>
 

Creating a View
Create a new file under the path Application/views/registration.php
Copy the below given code in your view.

<!DOCTYPE html>
<html>
<head>
<title>Registration form</title>
</head>

<body>
    <form method="post">
        <table width="600" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <td width="230">Enter Your Name </td>
    <td width="329"><input type="text" name="name"/></td>
  </tr>
  <tr>
    <td>Enter Your Email </td>
    <td><input type="text" name="email"/></td>
  </tr>
  <tr>
    <td>Enter Your Mobile </td>
    <td><input type="text" name="mobile"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="save" value="Save Data"/></td>
  </tr>
</table>

    </form>
</body>
</html>
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
<!DOCTYPE html>
<html>
<head>
<title>Registration form</title>
</head>
 
<body>
    <form method="post">
        <table width="600" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <td width="230">Enter Your Name </td>
    <td width="329"><input type="text" name="name"/></td>
  </tr>
  <tr>
    <td>Enter Your Email </td>
    <td><input type="text" name="email"/></td>
  </tr>
  <tr>
    <td>Enter Your Mobile </td>
    <td><input type="text" name="mobile"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="save" value="Save Data"/></td>
  </tr>
</table>
 
    </form>
</body>
</html>
 

Creating a Model
Create a new file under the path Application/models/Hello_Model.php
Copy the below given code in your model.

<?php
class Hello_Model extends CI_Model 
{
    function saverecords($name,$email,$mobile)
    {
    $query="insert into users values('','$name','$email','$mobile')";
    $this->db->query($query);
    }
}
1
2
3
4
5
6
7
8
9
<?php
class Hello_Model extends CI_Model 
{
    function saverecords($name,$email,$mobile)
    {
    $query="insert into users values('','$name','$email','$mobile')";
    $this->db->query($query);
    }
}
Calling/run Hello Controller’s savedata method
Open your web browser and Pass : http://localhost/CodeIgniter/index.php/Hello/savedata

Output : View Page
insert database in codeigniter
Output : Database


  

 
Latest Trending Technologies


CODEIGNITER TUTORIAL
CodeIgniter Tutorial
Codeigniter Overview
CodeIgniter Installing
CodeIgniter App Architecture
CodeIgniter MVC Framework
Controller
Views
Models
CODEIGNITER DATABASE
Insert Data Into Database
Display Data From Database
Delete Database Record
Update Database Record
Create Simple Registration Form
Create Simple Login Form
DB QUERY HELPER METHODS
Insert Data Into Database
CodeIgniter Interview Questions

 
Online Tutorials
HTML Tutorial
PHP Tutorial
MySQL Tutorial
WordPress Tutorial
Codeigniter Tutorial
Ajax Tutorial
Python Tutorial
SEO Tutorial
Laravel Tutorial
Offline Training
PHP Training
Laravel Training
Codeigniter Training
Wordpress Training
Digital Marketing Training
Seo Training
Android & Kotlin Training
Summer Internship
Development Services
Static/Dynamic Website Development
E-commerce Development
Responsive Designing
Logo Designing
Seo,On Page, Off Page,PPC
Contact Us
PHP Tutorial Point
Address : 1st floor, H-73, Sector-63, Noida

Email :phptpoint@gmail.com,
  info@phptpoint.com

Mob : +91 9015501897

Ph : 0120 - 4968730

Powered By PHP Tutorial Point(Phptpoint)

About us Offline Training Student Zone Blog Contact us




