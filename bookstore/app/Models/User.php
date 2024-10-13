<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'administration_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin() {
        return $this->administration_level > 0 ? true : false;
    }

    public function isSuperAdmin() {
        return $this->administration_level > 1 ? true : false;
    }

    public function ratings() {
        return $this->belongsToMany(Book::class,'ratings')->withTimestamps()->withPivot('value');
    }

    public function rated(Book $book) {
        return $this->ratings()->where('book_id',$book->id)->exists();
    }

    public function bookRating(Book $book) {
        return $this->ratings()->where('book_id',$book->id)->first()->pivot;
    }

    public function booksInCart() {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','book_id','bought','price'])->where('bought',false);
    }

    public function ratedpurches() {
        return $this->belongsToMany(Book::class)->withPivot(['bought'])->where('bought',true);
    }

    public function parchedProduct() {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','bought','price','created_at'])->orderByPivot('created_at','desc')->wherePivot('bought' , true);
    }

    public function pay(Book $book) {
        return $this->booksInCart->contains($book);
    }

    public function number_of_copies(Book $book) {
        return $this->booksInCart()->where('book_id',$book->id)->first()->pivot->number_of_copies;
    }

    public function updatePay(Book $book,Array $content) {
        $this->booksInCart()->updateExistingPivot($book->id,$content);
    }

    public function addBook(Book $book,Array $content) {
        $this->booksInCart()->attach($book->id,$content);
    }

    public function removeBook(Book $book) {
        $this->booksInCart()->detach($book->id);
    }

    public function count() {
        return $this->booksInCart()->count();
    }

}
