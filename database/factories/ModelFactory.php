<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'timezone' => config('app.timezone'),
        'name_order' => 'firstname_lastname',
        'confirmed' => true,
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Account\Account::class, function (Faker\Generator $faker) {
    return [
        'api_key' => str_random(30),
    ];
});

$factory->define(App\Models\Contact\Activity::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'activity_type_id' => function () {
            return factory(App\Models\Contact\ActivityType::class)->create()->id;
        },
        'description' => $faker->sentence,
        'summary' => $faker->sentence,
        'date_it_happened' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
    ];
});

$factory->define(App\Models\Contact\ActivityType::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'activity_type_category_id' => function () {
            return factory(App\Models\Contact\ActivityTypeCategory::class)->create()->id;
        },
        'translation_key' => $faker->sentence,
        'location_type' => $faker->word,
    ];
});

$factory->define(App\Models\Contact\ActivityTypeCategory::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'translation_key' => $faker->sentence,
        'name' => $faker->sentence,
    ];
});

$factory->define(App\Models\Contact\Reminder::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
    ];
});

$factory->define(App\Models\Contact\Contact::class, function (Faker\Generator $faker) {
    return [
        'account_id' => function () {
            return factory(App\Models\Account\Account::class)->create()->id;
        },
        'first_name' => 'John',
        'last_name' => 'Doe',
        'has_avatar' => false,
        'gender_id' => function () {
            return factory(App\Models\Contact\Gender::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\Contact\Gift::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'created_at' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
    ];
});

$factory->define(App\Models\Contact\Call::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'created_at' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
    ];
});

$factory->define(App\Models\Contact\Task::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'created_at' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
    ];
});

$factory->define(App\Models\Instance\SpecialDate::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'date' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
        'created_at' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeThisCentury()->getTimeStamp()),
    ];
});

$factory->define(App\Models\Contact\Note::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'body' => encrypt($faker->text(200)),
    ];
});

$factory->define(App\Models\Relationship\Relationship::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'relationship_type_id' => function () {
            return factory(App\Models\Relationship\RelationshipType::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\Relationship\RelationshipType::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'relationship_type_group_id' => function () {
            return factory(App\Models\Relationship\RelationshipTypeGroup::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\Relationship\RelationshipTypeGroup::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Offspring::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Call::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Account\Invitation::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Address::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Gender::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Journal\Entry::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Debt::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
    ];
});

$factory->define(App\Models\Journal\Day::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Tag::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Journal\JournalEntry::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Pet::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'pet_category_id' => factory(App\Models\Contact\PetCategory::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\PetCategory::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Contact\ContactFieldType::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
        'name' => 'Email',
        'protocol' => 'mailto:',
        'type' => 'email',
    ];
});

$factory->define(App\Models\Contact\ContactField::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
        'contact_field_type_id' => 1,
        'data' => 'john@doe.com',
    ];
});

$factory->define(App\Models\Contact\ReminderRule::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\Contact\Notification::class, function (Faker\Generator $faker) {
    $contact = factory(App\Models\Contact\Contact::class)->create();

    return [
        'account_id' => $contact->account_id,
        'contact_id' => $contact->id,
    ];
});

$factory->define(App\Models\User\Module::class, function (Faker\Generator $faker) {
    return [
        'account_id' => factory(App\Models\Account\Account::class)->create()->id,
    ];
});

$factory->define(App\Models\User\Changelog::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Instance\Instance::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Account\ImportJob::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Account\ImportJobReport::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Models\Settings\Term::class, function (Faker\Generator $faker) {
    return [
        'term_version' => $faker->realText(50),
        'term_content' => $faker->realText(50),
        'privacy_version' => $faker->realText(50),
        'privacy_content' => $faker->realText(50),
    ];
});

$factory->define(App\Models\Settings\Currency::class, function (Faker\Generator $faker) {
    return [
        'iso' => $faker->realText(10),
        'name' => $faker->realText(10),
        'symbol' => $faker->realText(10),
    ];
});

$factory->define(\Laravel\Cashier\Subscription::class, function (Faker\Generator $faker) {
    static $account_id;
    static $stripe_plan;
    static $name;
    static $stripe_id;

    return [
        'account_id' => $account_id,
        'name' => $name ?: $faker->randomElement(['main']),
        'stripe_id' => $stripe_id,
        'stripe_plan' => $stripe_plan ?: $faker->randomElement(['plan-1', 'plan-2', 'plan-3']),
        'quantity' => 1,
        'created_at' => now(),
    ];
});
