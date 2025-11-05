<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all roles that match user_types
        $all_roles = [
            'super_admin',    // Full system access - maps to admin user_type
            'admin',          // General admin access - maps to admin user_type  
            'employer',       // Company/job management - maps to employer user_type
            'job_seeker',     // Job searching - maps to employee, internee, volunteer user_types
            'moderator',      // Content moderation - maps to admin user_type
            'support',        // Customer support - maps to admin/employer user_types
        ];

        foreach ($all_roles as $role) {
            Role::create(['name' => $role]);
        }

        // Define all permissions for the job portal
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            'impersonate users',
            'activate users',
            'deactivate users',
            'manage roles and permissions',

            // Company Management
            'view companies',
            'create companies',
            'edit companies',
            'delete companies',
            'verify companies',
            'suspend companies',
            'manage company subscriptions',
            'export company data',

            // Job Management
            'view jobs',
            'create jobs',
            'edit jobs',
            'delete jobs',
            'publish jobs',
            'unpublish jobs',
            'feature jobs',
            'verify jobs',
            'archive jobs',
            'export jobs',
            'manage job categories',
            'bulk job operations',

            // Job Seeker & CV Management
            'view job seekers',
            'create job seekers',
            'edit job seekers',
            'delete job seekers',
            'view cv profiles',
            'manage cv profiles',
            'export cv data',
            'manage cv templates',

            // Application Management
            'view applications',
            'create applications',
            'edit applications',
            'delete applications',
            'update application status',
            'view application analytics',
            'export applications',
            'manage application workflow',

            // AI & Matching System
            'view ai analysis',
            'run ai matching',
            'manage ai models',
            'view match results',
            'export match data',
            'train ai models',
            'view ai performance',

            // Payment & Subscription
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'refund transactions',
            'view payment analytics',
            'manage payment plans',
            'manage subscriptions',
            'process refunds',
            'view subscription analytics',
            'export transactions',
            'view transaction reports',
            'manage transaction disputes',

            // Category Management
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'manage category hierarchy',
            'import categories',
            'export categories',

            // Occupational Category Management
            'view occupational categories',
            'create occupational categories',
            'edit occupational categories',
            'delete occupational categories',
            'manage occupational categories',
            'import occupational categories',

            // Job Category Management
            'view job categories',
            'create job categories',
            'edit job categories',
            'delete job categories',
            'manage job categories hierarchy',
            'import job categories',

            // Industry Management
            'view industries',
            'create industries',
            'edit industries',
            'delete industries',
            'manage industries',
            'import industries',

            // Location Management
            'view locations',
            'create locations',
            'edit locations',
            'delete locations',
            'manage locations hierarchy',
            'import locations',
            'export locations',

            // Job Type Management
            'view job types',
            'create job types',
            'edit job types',
            'delete job types',
            'manage job types',
            'import job types',

            // Salary Range Management
            'view salary ranges',
            'create salary ranges',
            'edit salary ranges',
            'delete salary ranges',
            'manage salary ranges',
            'import salary ranges',

            // Experience Level Management
            'view experience levels',
            'create experience levels',
            'edit experience levels',
            'delete experience levels',
            'manage experience levels',
            'import experience levels',

            // Education Level Management
            'view education levels',
            'create education levels',
            'edit education levels',
            'delete education levels',
            'manage education levels',
            'import education levels',

            // Payment Plan Management
            'view payment plans',
            'create payment plans',
            'edit payment plans',
            'delete payment plans',
            'activate payment plans',
            'deactivate payment plans',
            'manage pricing tiers',
            'import payment plans',

            // Job Promotion Management
            'view job promotions',
            'create job promotions',
            'edit job promotions',
            'delete job promotions',
            'activate job promotions',
            'deactivate job promotions',
            'manage promotion campaigns',
            'view promotion analytics',

            // Company Subscription Management
            'view company subscriptions',
            'create company subscriptions',
            'edit company subscriptions',
            'delete company subscriptions',
            'activate company subscriptions',
            'deactivate company subscriptions',
            'manage subscription plans',
            'renew subscriptions',

            // API Credentials Management
            'view api credentials',
            'create api credentials',
            'edit api credentials',
            'delete api credentials',
            'regenerate api keys',
            'manage api access',
            'view api usage',
            'export api credentials',

            // API Sync Log Management
            'view api sync logs',
            'create api sync logs',
            'edit api sync logs',
            'delete api sync logs',
            'retry failed syncs',
            'view sync analytics',
            'export sync logs',

            // Notification & Email
            'view notifications',
            'send notifications',
            'manage email templates',
            'send bulk emails',
            'view email analytics',
            'manage sms templates',
            'manage push notifications',

            // Analytics & Reporting
            'view analytics',
            'view reports',
            'export reports',
            'view dashboard',
            'view system metrics',
            'view employer dashboard',
            'view job seeker dashboard',
            'view admin dashboard',
            'view financial dashboard',
            'export analytics data',
            'view real-time analytics',

            // System & Settings
            'manage settings',
            'manage countries',
            'manage payment gateways',
            'view system logs',
            'manage api keys',
            'manage webhooks',
            'system maintenance',
            'clear cache',
            'manage backups',

            // Financial Management
            'view financial reports',
            'manage payments',
            'view transaction history',
            'view revenue reports',
            'manage invoices',
            'view tax reports',

            // Data Management
            'import data',
            'export data',
            'bulk operations',
            'data migration',
            'data cleanup',

            // Super Admin Only
            'super_admin only',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Give super_admin all permissions
        $superAdminRole = Role::where(['name' => 'super_admin'])->first();
        $allPermissions = Permission::all();
        $superAdminRole->syncPermissions($allPermissions);


        // Create Sam as super_admin
        $samUser = User::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'first_name' => 'Samack',
            'last_name' => 'Edu',
            'email' => 'samuelkiiraeluk@gmail.com',
            'phone' => '+256754428612',
            'user_type' => 'admin',
            'email_verified_at' => now(),
            'country_code' => 'UG',
            'is_active' => true,
        ]);
        $samUser->assignRole('super_admin');

        // Create Celeste as super_admin
        $celesteUser = User::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'first_name' => 'Celeste',
            'last_name' => 'Paul',
            'email' => 'celestialpsalms@gmail.com',
            'phone' => '+256700000001',
            'user_type' => 'admin',
            'email_verified_at' => now(),
            'country_code' => 'UG',
            'is_active' => true,
        ]);
        $celesteUser->assignRole('super_admin');

    }
}