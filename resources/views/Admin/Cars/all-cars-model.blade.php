 <div class="" style="display:block;clear:both">
     <label for="">نوع السيارة</label>
     <select id="carManufacturer" class="form-control" name="type">
         <option value="">كل الانواع</option>
         @foreach($brands as $item)
             <option value="{{ $item->name }}"> {{ $item->name }}</option>

         @endforeach
     </select>

 </div>
