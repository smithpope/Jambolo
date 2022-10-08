<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artisan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $businessname = $request->business_name;
        $phonenumber = $request->phone_number;
        $email = $request->email;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $address = $request->address;
        $category = $request->category_id;
        $association = $request->association;
        $bankname = $request->bank_name;
        $accountnumber = $request->account_number;
        $bank = $request->bank;
        $passport = $request->passport;

        $validator = validator::make($request->all(), [
            'firstname' => ['required', 'string', 'min:2', 'max:20'],
            'lastname' => ['required', 'string','min:2', 'max:20'],
            'business_name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min_digits:11', 'max_digits:11'],
            'email' => ['required', 'email:rfc'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'association' => ['required', 'string'],
            'bank_name' => ['required', 'string', 'min:3'],
            'account_number' => ['required', 'numeric', 'min_digits:10', 'max_digits:10'],
            'bank' => ['required', 'string'],
            'passport' => ['string', 'nullable', 'max:1999']
        ]);

        if($validator->fails()){
            return response([
                'error' => 'Invalid Input',
                'info' => $validator->errors(),
            ]);
        }

        $create = Artisan::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'business_name' => $businessname,
            'phone_number' => $phonenumber,
            'email' => $email,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'address' => $address,
            'category_id' => $category,
            'association' => $association,
            'bank_name' => $bankname,
            'account_number' => $accountnumber,
            'bank' => $bank,
            'passport' => $passport
        ]);

        return response([
            "Artisan Successfully Created",
            $create
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Artisan::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return response($request->all());
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $businessname = $request->business_name;
        $phonenumber = $request->phone_number;
        $email = $request->email;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $address = $request->address;
        $category = $request->category_id;
        $association = $request->association;
        $bankname = $request->bank_name;
        $accountnumber = $request->account_number;
        $bank = $request->bank;
        $passport = $request->passport;

        $artisan = Artisan::findOrFail($id);

        $validator = validator::make($request->all(), [
            'firstname' => ['required', 'string', 'min:2', 'max:20'],
            'lastname' => ['required', 'string','min:2', 'max:20'],
            'business_name' => ['required', 'string', 'min:3', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min_digits:11', 'max_digits:11', 'digits:11'],
            //'email' => ['required', 'email:rfc'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'association' => ['required', 'string'],
            'bank_name' => ['required', 'string', 'min:3'],
            'account_number' => ['required', 'numeric', 'min_digits:10', 'max_digits:10', 'digits:10'],
            'bank' => ['required', 'string'],
            'passport' => ['string', 'nullable', 'max:1999']
        ]);

        if ($validator->fails()){
            return response([
                'error' => 'Invalid Data',
                'info' =>$validator->errors(),
            ]);
        }

        $artisan-> update([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'business_name' => $businessname,
            'phone_number' => $phonenumber,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'address' => $address,
            'category_id' => $category,
            'association' => $association,
            'bank_name' => $bankname,
            'account_number' => $accountnumber,
            'bank' => $bank,
            'passport' => $passport
        ]);

        return response([
            "Artisan Successfully Updated",
            $artisan
        ]);
    }


    //image upload endpoint
    public function upload(Request $request){
        $passport = $request->passport;

        $validator = validator::make($request->all(),[
            'passport' => ['image', 'nullable', 'max:1999']
        ]);

        if ($validator->fails()){
            return response([
                'error' => "Upload Failed",
                'info' => $validator->errors()
            ]);
        }

        if ($request->hasFile('passport')){
            $fileNameWithExt = $request->file('passport')->getClientOriginalName();

            //get file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //GET JUST EXTENSION
            $extension = $request->file('passport')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image path
            $path = $request->file('passport')->storeAs('public/image', $fileNameToStore);
            //$url = Storage::url($path);
            $host = url($path);

            return $host;
        }
        //else store dummy image
        else {
            $fileNameToStore = 'noname.jpg';

            return $fileNameToStore;
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Artisan::findorFail($id);

        $delete->delete($id);
        $all = Artisan::all();
        return response([
            "Artisan Successfully Deleted",
            $all
        ]);
    }
}
