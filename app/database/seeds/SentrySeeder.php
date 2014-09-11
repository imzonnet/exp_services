<?php
class SentrySeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        $user = Sentry::createUser(array(
            'email'       => 'admin@admin.com',
            'password'    => "admin",
            'first_name'  => 'John',
            'last_name'   => 'McClane',
            'activated'   => 1,
            'phone' => '123456789',
            'skype' => 'skypename',
            'sex' => 'male',
            'profile' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"

        ));

        $user2 = Sentry::createUser(array(
            'email'       => 'member@member.com',
            'password'    => "member1",
            'first_name'  => 'Bruce',
            'last_name'   => 'Wayne',
            'activated'   => 1,
            'phone' => '23564586',
            'skype' => 'skypename',
            'sex' => 'male',
            'profile' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
        ));

        $groupAdmin = Sentry::createGroup(array(
            'name'        => 'Supporter',
            'permissions' => array(
                'supporter' => 1
            ),
        ));

        $groupMember = Sentry::createGroup(array(
            'name'        => 'User',
            'permissions' => array(
                'user' => 1
            ),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::findUserByLogin('admin@admin.com');
        $adminGroup = Sentry::findGroupByName('supporter');
        $adminUser->addGroup($adminGroup);

        $mUser  = Sentry::findUserByLogin('member@member.com');
        $mGroup = Sentry::findGroupByName('user');
        $mUser->addGroup($mGroup);
	}

}