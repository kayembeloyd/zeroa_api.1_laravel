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
        echo ('Seeding locations...\n');
        $locations = \App\Models\Location::factory(70)->create();

        /*
        // Users
        $NUMBER_OF_USERS = 5;

        echo ('Seeding users...\n');
        $users = \App\Models\User::factory($NUMBER_OF_USERS)->create();
        echo ("Finished Seeding " . $NUMBER_OF_USERS . " users\n");

        // Houses
        $NUMBER_OF_HOUSES = 100;

        echo ('Seeding houses...\n');
        $houses = \App\Models\House::factory($NUMBER_OF_HOUSES)->create();
        echo ("Finished Seeding " . $NUMBER_OF_HOUSES . " houses\n");

        // Locations
        echo ('Seeding locations...\n');
        $locations = \App\Models\Location::factory(70)->create();
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

        // Landlords
        $NUMBER_OF_LANDLORDS_FOR_EACH_HOUSE = 2;

        echo ('Seeding landlords...\n');
        $landlords = \App\Models\Landlord::factory($NUMBER_OF_LANDLORDS_FOR_EACH_HOUSE * $NUMBER_OF_HOUSES)->create();
        foreach ($houses as $house) {
            $house->landlords()->save($landlords->random());
        }
        echo ("Finished Seeding " . $NUMBER_OF_LANDLORDS_FOR_EACH_HOUSE . " landlords for each of the " . $NUMBER_OF_HOUSES . " houses\n");

        // Contacts 
        $NUMBER_OF_CONTACTS_PER_LANDLORD = 2;
        echo ('Seeding contacts...\n');
        foreach ($landlords as $landlord) {
            $contacts = \App\Models\Contact::factory($NUMBER_OF_CONTACTS_PER_LANDLORD)->create();
            $landlord->contacts()->saveMany($contacts);
        }
        echo ("Finished Seeding " . $NUMBER_OF_CONTACTS_PER_LANDLORD * $NUMBER_OF_LANDLORDS_FOR_EACH_HOUSE * $NUMBER_OF_HOUSES . " contacts for each landlord\n");

        // User houses 
        echo ('Seeding saved houses...\n');
        foreach ($users as $user) {
            $user->houses()->save($houses->random());
        }
        echo ("Finished Seeding atleast one saved house for each of the " . $NUMBER_OF_HOUSES . " houses \n"); */
    }
}
