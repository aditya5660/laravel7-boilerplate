@if (session('success'))    
<div class="alert alert-success alert-bold" >
	<div class="alert-text">
        <strong><i class="la la-check "></i> Success</strong>, 
        {{ session('success') }}
    </div>
</div>
@endif
@if (session('error'))    
<div class="alert alert-danger alert-bold" >
    <div class="alert-text">
        <strong><i class="la la-exclamation-triangle"></i> Error</strong>, 
        {{ session('error') }}
    </div>
</div>
@endif
@if (session('warning'))    
<div class="alert alert-warning alert-bold" >
    <div class="alert-text">
        <strong><i class="la la-exclamation-triangle"></i> Warning</strong>, 
        {{ session('warning') }}
    </div>
</div>
@endif