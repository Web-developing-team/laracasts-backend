<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class RoleTest extends TestCase
{


    public function test_view_any_roles_authorization_fail()
    {
        $admin = Admin::factory()->create();

        $response = $this
                            ->actingAs($admin)
                            ->getJson('/api/roles');

        $response->assertStatus(403);
    }


    public function test_view_any_roles()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'view-any-role')->id]);

        $response = $this
                            ->actingAs($admin)
                            ->getJson('/api/roles');

        $response->assertStatus(200);
    }


    public function test_create_role_validation_fail()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'create-role')->id]);

        $response = $this
                            ->actingAs($admin)
                            ->postJson('/api/roles', [ 'name' => '']);

        $response->assertStatus(422);

        $response = $this
                            ->actingAs($admin)
                            ->postJson('/api/roles', [ 'name' => 'a']);

        $role = Role::factory()->create();

        $response = $this
                            ->actingAs($admin)
                            ->postJson('/api/roles', [ 'name' => $role->name ]);

        $response->assertStatus(422);
    }

    public function test_create_role()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'create-role')->id]);

        $role = Role::factory()->make();

        $response = $this
                            ->actingAs($admin)
                            ->postJson('/api/roles', [ 'name' => $role->name]);

        $response->assertStatus(201);
    }

    public function test_view_role_authoriztion_fail()
    {
        $admin = Admin::factory()->create();

        $role = Role::factory()->create();

        $response = $this
                            ->actingAs($admin)
                            ->getJson('/api/roles/'.$role->id);

        $response->assertStatus(403);
    }

    public function test_view_role()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'view-role')->id]);

        $role = Role::factory()->create();

        $response = $this
                            ->actingAs($admin)
                            ->getJson('/api/roles/'.$role->id);

        $response->assertStatus(200);
    }

    public function test_update_role_authrization_fail()
    {
        $admin = Admin::factory()->create();

        $role = Role::factory()->create();

        $role_make = Role::factory()->make();

        $response = $this
                            ->actingAs($admin)
                            ->putJson('/api/roles/'.$role->id, [ 'name' => $role_make->name ]);

        $response->assertStatus(403);
    }

    public function test_update_role()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'update-role')->id]);

        $role = Role::factory()->create();

        $role_make = Role::factory()->make();

        $response = $this
                            ->actingAs($admin)
                            ->putJson('/api/roles/'.$role->id, [ 'name' => $role_make->name ]);

        $response->assertStatus(200);
    }



    public function test_delete_role()
    {
        $admin = Admin::factory()->create();

        $admin->permissions()->sync([Permission::firstWhere('name', 'delete-role')->id]);

        $role = Role::factory()->create();

        $response = $this
                            ->actingAs($admin)
                            ->deleteJson('/api/roles/'.$role->id);

        $response->assertStatus(200);
    }
}
