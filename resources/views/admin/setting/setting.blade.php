@extends('layout.dashboard.app')

@section('title')
Setting
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
@endpush
@endsection

@section('body')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Update Setting</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.setting.update',$setting->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Site Name</label>
                                <input type="text" value="{{ $setting->site_name }}" name="site_name" class="form-control" placeholder="Enter site name">
                                @error('site_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" value="{{ $setting->email }}" name="email" class="form-control" placeholder="Enter email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control" placeholder="Enter phone">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" value="{{ $setting->country }}" class="form-control" placeholder="Enter country">
                                @error('country')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" value="{{ $setting->city }}" class="form-control" placeholder="Enter city">
                                @error('city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" value="{{ $setting->street }}" class="form-control" placeholder="Enter street">
                                @error('street')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Facebook</label>
                                <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control" placeholder="Facebook link">
                                @error('facebook')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Twitter</label>
                                <input type="text" name="tiwter" value="{{ $setting->tiwter }}" class="form-control" placeholder="Twitter link">
                                @error('tiwter')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Instagram</label>
                                <input type="text" name="instgram" value="{{ $setting->instgram }}" class="form-control" placeholder="Instagram link">
                                @error('instgram')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">YouTube</label>
                                <input type="text" name="youtube" value="{{ $setting->youtube }}" class="form-control" placeholder="YouTube link">
                                @error('youtube')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Small Description</label>
                                <input type="text" name="SmallDesc" value="{{ $setting->SmallDesc }}" class="form-control" placeholder="Short description">
                                @error('SmallDesc')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">contact Website</label>
                               <textarea type="text" name="contact"  class="form-control" placeholder="Contact">{{ $setting->contact }}</textarea> 
                                @error('contact')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                          <input type="hidden" name="id" value="{{ $setting->id }}">
                            <div class="col-md-6">
                                <label class="form-label">Logo :</label>
                                <input type="file" class="dropify" name="logo" class="form-control">
                                
                                @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <img class="img-thumbnail" src="{{ asset($setting->logo) }}" >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Favicon :</label>
                                <input type="file" class="dropify" name="favicon" class="form-control">
                                @error('favicon')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <img class="img-thumbnail" src="{{ asset($setting->favicon) }}" >
                            </div>

                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function(){
        $('.dropify').dropify({
            messages: {
  'default': 'Drop a file here',
        'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
            }
        });
        
    });
    </script>    
@endpush