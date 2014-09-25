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
            'last_name'   => 'Nguyen',
            'activated'   => 1,
            'phone' => '123456789',
            'skype' => 'skypename',
            'sex' => 'male',
            'avatar' => 'public/images/avatar.png',
            'profile' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"

        ));

        $user = Sentry::createUser(array(
            'email'       => 'sup@sup.com',
            'password'    => "support",
            'first_name'  => 'John',
            'last_name'   => 'McClane',
            'activated'   => 1,
            'phone' => '123456789',
            'skype' => 'skypename',
            'sex' => 'male',
            'avatar' => 'public/images/avatar4.png',
            'profile' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"

        ));

        $user2 = Sentry::createUser(array(
            'email'       => 'member@member.com',
            'password'    => "member",
            'first_name'  => 'Bruce',
            'last_name'   => 'Wayne',
            'activated'   => 1,
            'phone' => '23564586',
            'skype' => 'skypename',
            'sex' => 'male',
            'avatar' => 'public/images/avatar2.png',
            'profile' => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s"
        ));

        $groupAdmin = Sentry::createGroup(array(
            'name'        => 'administer',
            'permissions' => array(
                'administer' => 1
            ),
        ));

        $groupSup = Sentry::createGroup(array(
            'name'        => 'supporter',
            'permissions' => array(
                'supporter' => 1
            ),
        ));

        $groupMember = Sentry::createGroup(array(
            'name'        => 'user',
            'permissions' => array(
                'user' => 1
            ),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::findUserByLogin('admin@admin.com');
        $adminGroup = Sentry::findGroupByName('administer');
        $adminUser->addGroup($adminGroup);

        // Assign user permissions
        $spUser  = Sentry::findUserByLogin('sup@sup.com');
        $spGroup = Sentry::findGroupByName('supporter');
        $spUser->addGroup($spGroup);

        $mUser  = Sentry::findUserByLogin('member@member.com');
        $mGroup = Sentry::findGroupByName('user');
        $mUser->addGroup($mGroup);
	}

}