<x-master>

   

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
