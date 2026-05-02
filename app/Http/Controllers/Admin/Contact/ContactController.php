<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $contatcs = Contact::when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')->orWhere('email', 'like', '%' . request()->search . '%');
        })->when(request()->status !== null, function ($query) {
            $query->where('status', request()->status);
        });
        $contatcs = $contatcs->orderBy($Sort_By, $order_by)->paginate($limit);
       
        return view('admin.Contact.index',compact('contatcs'));
    }



    
    public function show($id){
   $contact=Contact::findOrFail($id);
   if($contact->status==0){
    $contact->update([
        'status'=>1
    ]);
    
   }
    return view('admin.contact.show',compact('contact'));
    }
    public function destory($id){
$contact=Contact::findOrFail($id);
$contact->delete();
flash()->success('Your Deletd The Contact');
return redirect()->back();
  
    }
}
