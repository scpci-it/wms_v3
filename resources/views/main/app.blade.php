<!DOCTYPE html>
<html>
<head>
	<title>Warehouse Management System Version 3.1</title>

	
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>


</head>


<body style="background-color: #c5c5c5">


 <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

 <ul class ="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Create Item
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/categories/create">Create Category</a>
        <a class="dropdown-item" href="/warehouses/create">Create Warehouse</a>
        <a class="dropdown-item" href="/locations/create">Create Location</a>


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Products
      </a>

      <div class="dropdown-menu">
        <a class="dropdown-item" href="/products/create">Create Product</a>
        <a class="dropdown-item" href="/inventory_products">Inventory</a>  
        <a class="dropdown-item" href="/product_transactions/issue_out">Issue Out</a>
        <a class="dropdown-item" href="/product_transactions/issue_in">Issue In</a>
        <a class="dropdown-item" href="/product_transactions">Transaction Movements</a>
      </div>
    </li>


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Materials
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/materials/create">Create Material</a> 
        <a class="dropdown-item" href="/inventory_material">Inventory</a> 
        <a class="dropdown-item" href="/material_transactions/issue_out">Issue Out</a>
        <a class="dropdown-item" href="/material_transactions/issue_in">Issue In</a>
        <a class="dropdown-item" href="/material_transactions/internal">Internal Transfer</a> 
        <a class="dropdown-item" href="/material_transactions">Transaction Movements</a> 

      </div>
    </li>


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Spare Parts
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/spare_parts/create">Create Spare Parts</a> 
        <a class="dropdown-item" href="/inventory_spare_parts">Inventory</a> 
        <a class="dropdown-item" href="/spare_parts_transactions/issue_out">Issue Out</a>
        <a class="dropdown-item" href="/spare_parts_transactions/issue_in">Issue In</a>
        <a class="dropdown-item" href="/spare_parts_transactions/internal">Internal Transfer</a> 
        <a class="dropdown-item" href="/spare_parts_transactions">Transaction Movements</a> 

      </div>
    </li>

  </ul>

  
  <ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
  </ul>


</nav> 

<br>
<br>

	@yield('content')

</body>

<script>

  @yield('scripts')

</script>

</html>