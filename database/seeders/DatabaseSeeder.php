<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        $NUMBER_OF_USERS = 5;

        echo ('Seeding users...\n');
        $users = \App\Models\User::factory($NUMBER_OF_USERS)->create();
        echo ("Finished Seeding " . $NUMBER_OF_USERS . " users\n");

        // Houses
        $NUMBER_OF_HOUSES = 50;

        echo ('Seeding houses...\n');
        $houses = \App\Models\House::factory($NUMBER_OF_HOUSES)->create();
        echo ("Finished Seeding " . $NUMBER_OF_HOUSES . " houses\n");

        // Locations
        echo ('Seeding locations...\n');
        $locations = \App\Models\Location::factory(20)->create();
        foreach ($houses as $house) {
            $house->location()->associate($locations->random());
            $house->save();
        }
        echo ("Finished Seeding a location for each of the " . $NUMBER_OF_HOUSES . " houses\n");

        //Images 
        $NUMBER_OF_IMAGES_FOR_EACH_HOUSE = 4;

        echo ('Seeding images...\n');
        foreach ($houses as $house) {
            $images = \App\Models\Image::factory($NUMBER_OF_IMAGES_FOR_EACH_HOUSE)->create();
            $house->images()->saveMany($images);
        }
        echo ("Finished Seeding " . $NUMBER_OF_IMAGES_FOR_EACH_HOUSE . " images for each of the " . $NUMBER_OF_HOUSES . " houses\n");

        // Landlord (contacts)
        $NUMBER_OF_LANDLORD_CONTACTS_FOR_EACH_HOUSE = 2;

        echo ('Seeding landlord (contacts)...\n');
        $landlords = \App\Models\Landlord::factory($NUMBER_OF_LANDLORD_CONTACTS_FOR_EACH_HOUSE * $NUMBER_OF_HOUSES)->create();
        foreach ($houses as $house) {
            $house->landlords()->save($landlords->random());
        }
        echo ("Finished Seeding " . $NUMBER_OF_LANDLORD_CONTACTS_FOR_EACH_HOUSE . " landlord contacts for each of the " . $NUMBER_OF_HOUSES . " houses\n");

        // User houses 
        echo ('Seeding saved houses...\n');
        foreach ($users as $user) {
            $user->houses()->save($houses->random());
        }
        echo ("Finished Seeding atleast one saved house for each of the " . $NUMBER_OF_HOUSES . " houses \n");
    }
}
