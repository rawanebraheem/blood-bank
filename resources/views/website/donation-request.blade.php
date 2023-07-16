<x-master>

    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span
                        class="sr-only">(current)</span></a>
            </li>
           
            <li class="nav-item ">
                <a class="nav-link"  href="{{ url('web/articles') }}">المقالات</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
            </li>
        </ul>
    </x-slot>

    <div class="requests">
        <div class="content">
    <div class="patients">
        
        <div class="details">
            <div class="blood-type">
                <h2 dir="ltr">{{$donation_request->bloodType->name}}</h2>
            </div>
            <ul>
                <li><span>{{$donation_request->patient_name}}</span>  </li>
                <li><span>المدينة:</span>{{$donation_request->city->name}}</li>
                <li><span>مستشفى:</span> {{$donation_request->hospital_name}}</li>
                <li><span>عنوان المستشفى:</span> {{$donation_request->hospital_address}}</li>
                <li><span>رقم المريض:</span> {{$donation_request->patient_phone}}</li>
                <li><span>عمر المريض:</span> {{$donation_request->patient_age}}</li>
                <li><span>عدد الاكياس:</span> {{$donation_request->bags_num}}</li>
                <li><span>التفاصيل:</span> {{$donation_request->details}}</li>

            </ul>
            
           
        </div>
    </div>
</div>


        
      
            
           
    </div>



        </div>
 
</x-master>
