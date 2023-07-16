<x-master>
  <x-slot name="navbar">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span
                    class="sr-only">(current)</span></a>
        </li>
       
        <li class="nav-item active">
            <a class="nav-link"  href="{{ url('web/articles') }}">المقالات</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
        </li>
    </ul>
</x-slot>
       

  <livewire:favtoggle/> 
      
  
</x-master>
