{{-- registration form --}}
{{-- registration page with error handling methods --}}


 {{-- basic information --}}
 <div class="row app-auth-form text-left">
     {{-- first_name form item --}}
     <div class="col-md-6 mt-4 p-2">
         <label for="" class="app-text-medium">First Name:</label><br>
         <div class="auth-form-msg"></div>
         <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
         @error('first_name')
             <span class="text-sm text-red" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
     </div>
 
     {{-- last_name form item --}}
     <div class="col-md-6 mt-4 p-2">
         <label for="" class="app-text-medium">Last Name:</label><br>
         <div class="auth-form-msg"></div>
         <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
         @error('last_name')
             <span class="text-sm text-red" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
     </div>
 
     {{-- phone_number form item --}}
     <div class="col-md-6 mt-4 p-2">
         <label for="" class="app-text-medium">Phone number:</label><br>
         <div class="auth-form-msg"></div>
         <input type="text" class="auth-phone" name="phone_number" placeholder="0712345678"
             value="{{ old('phone_number') }}" required>
         @error('phone_number')
             <span class="text-sm text-red" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
     </div>
 
     {{-- id_number form item --}}
     <div class="col-md-6 mt-4 p-2">
         <label for="" class="app-text-medium">I.D number:</label><br>
         <div class="auth-form-msg"></div>
         <input type="text" name="id_number" placeholder="I.D number" value="{{ old('id_number') }}" required>
         @error('id_number')
             <span class="text-sm text-red" role="alert">
                 <strong class="font-red">{{ $message }}</strong>
             </span>
         @enderror
     </div>
 
 </div>
 

 