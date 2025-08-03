import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
            role: string;
        } | null;
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="IT Support & Inventory Management" />
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <div className="flex items-center justify-between px-6 py-4">
                    <div className="flex items-center space-x-2">
                        <div className="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span className="text-white font-bold text-lg">🛠️</span>
                        </div>
                        <span className="text-xl font-bold text-gray-900 dark:text-white">IT Support</span>
                    </div>
                    <div className="flex space-x-4">
                        {auth.user ? (
                            <>
                                <Link href="/dashboard">
                                    <Button variant="outline">Dashboard</Button>
                                </Link>
                                <span className="px-3 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    Welcome, {auth.user.name}!
                                </span>
                            </>
                        ) : (
                            <>
                                <Link href="/login">
                                    <Button variant="outline">Login</Button>
                                </Link>
                                <Link href="/register">
                                    <Button>Register</Button>
                                </Link>
                            </>
                        )}
                    </div>
                </div>

                {/* Hero Section */}
                <div className="max-w-7xl mx-auto px-6 py-16">
                    <div className="text-center mb-16">
                        <h1 className="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                            🖥️ IT Support & Inventory Management
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                            Streamline your IT operations with comprehensive inventory tracking, 
                            employee management, and efficient ticket handling system.
                        </p>
                        {!auth.user && (
                            <div className="flex justify-center space-x-4">
                                <Link href="/register">
                                    <Button size="lg" className="px-8 py-3">
                                        Get Started 🚀
                                    </Button>
                                </Link>
                                <Link href="/login">
                                    <Button variant="outline" size="lg" className="px-8 py-3">
                                        Sign In
                                    </Button>
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">👥</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Employee Management
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Manage employee records with contact details, positions, and departments.
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📦</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Inventory Tracking
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Track IT assets with serial numbers, warranties, assignments, and locations.
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">🎫</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Support Tickets
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Create and manage IT support requests with priority levels and status tracking.
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">🔍</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Advanced Search
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Quickly find employees, inventory items, and tickets with powerful search functionality.
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">👨‍💼</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Role-Based Access
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Admin and User roles with appropriate permissions for different functionalities.
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <div className="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📊</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Dashboard Analytics
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Get insights with comprehensive statistics and recent activity summaries.
                            </p>
                        </div>
                    </div>

                    {/* System Overview */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                        <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                            🚀 Complete IT Management Solution
                        </h2>
                        <div className="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 className="font-semibold text-gray-900 dark:text-white mb-3">For Administrators:</h4>
                                <ul className="space-y-2 text-gray-600 dark:text-gray-300">
                                    <li>• Manage all employees and inventory items</li>
                                    <li>• Assign IT assets to employees</li>
                                    <li>• Handle and assign support tickets</li>
                                    <li>• View comprehensive system analytics</li>
                                </ul>
                            </div>
                            <div>
                                <h4 className="font-semibold text-gray-900 dark:text-white mb-3">For Users:</h4>
                                <ul className="space-y-2 text-gray-600 dark:text-gray-300">
                                    <li>• Create and track support tickets</li>
                                    <li>• View assigned inventory items</li>
                                    <li>• Monitor ticket status and priority</li>
                                    <li>• Access personal dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {/* Call to Action */}
                    {!auth.user && (
                        <div className="text-center mt-16">
                            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                                Ready to Get Started? 🎯
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 mb-6">
                                Join our IT Support system and streamline your operations today!
                            </p>
                            <Link href="/register">
                                <Button size="lg" className="px-12 py-4 text-lg">
                                    Create Account 📝
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>

                {/* Footer */}
                <div className="border-t border-gray-200 dark:border-gray-700 py-8">
                    <div className="max-w-7xl mx-auto px-6 text-center">
                        <p className="text-gray-600 dark:text-gray-400">
                            💻 Built with Laravel & React • Secure & Scalable IT Management
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}