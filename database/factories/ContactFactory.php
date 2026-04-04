<?php

namespace Database\Factories;

use App\Models\Contact;
use Faker\Provider\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'title'=>fake()->title(),
            'body'=>fake()->paragraph(10),
            'email'=>fake()->email(),
            'phone'=>fake()->PhoneNumber(),   
            'ip_address'=>fake()->ipv4(),   
        ];
    }
}
