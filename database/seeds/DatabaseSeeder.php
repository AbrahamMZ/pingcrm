<?php

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\Requirement;
use App\Models\Status;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $account = Account::create(['name' => 'Acme Corporation']);
        Status::createMany(
            ['text' => 'Por Cargar', 'key' => Status::STATUS_KEY_PENDING],
            ['text' => 'En Revision', 'key' => Status::STATUS_KEY_REVIEW],
            ['text' => 'Validos', 'key' => Status::STATUS_KEY_VALID],
            ['text' => 'Invalidos', 'key' => Status::STATUS_KEY_INVALID],
            ['text' => 'Excluidos', 'key' => Status::STATUS_KEY_EXCLUDED],
        );


        factory(User::class)->create([
            'account_id' => $account->id,
            'first_name' => 'Admin',
            'last_name' => 'Terrentro',
            'email' => 'admin@terrentro.com',
            'owner' => true,
        ]);

        factory(User::class, 5)->create(['account_id' => $account->id]);

        $organizations = factory(Organization::class, 100)
            ->create(['account_id' => $account->id]);

        factory(Contact::class, 100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });

        factory(Requirement::class, 50)->create();
        factory(Template::class, 5)->create();
        // factory(Expedient::class, 100)->create();
    }
}
