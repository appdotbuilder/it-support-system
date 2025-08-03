import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

interface Stats {
    employees: number;
    inventory_items: number;
    available_items: number;
    assigned_items: number;
    total_tickets: number;
    open_tickets: number;
    in_progress_tickets: number;
    resolved_tickets: number;
}

interface Ticket {
    id: number;
    title: string;
    status: string;
    priority: string;
    created_at: string;
    created_by: {
        name: string;
    };
    assigned_to?: {
        name: string;
    };
}

interface InventoryItem {
    id: number;
    name: string;
    status: string;
    brand: string;
    model: string;
    category: {
        name: string;
    };
    assigned_employee?: {
        name: string;
    };
}

interface Props {
    stats: Stats;
    recentTickets: Ticket[];
    recentItems: InventoryItem[];
    isAdmin: boolean;
    [key: string]: unknown;
}

const getStatusColor = (status: string) => {
    switch (status) {
        case 'Open': return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
        case 'In Progress': return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
        case 'Resolved': return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        case 'Closed': return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        case 'Available': return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        case 'Assigned': return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
        case 'In Repair': return 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200';
        case 'Retired': return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        default: return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
    }
};

const getPriorityColor = (priority: string) => {
    switch (priority) {
        case 'High': return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
        case 'Medium': return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
        case 'Low': return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        default: return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
    }
};

export default function Dashboard({ stats, recentTickets, recentItems, isAdmin }: Props) {
    return (
        <AppShell>
            <Head title="Dashboard" />
            
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🏠 Dashboard
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            {isAdmin ? 'Admin Overview' : 'Your IT Support Overview'}
                        </p>
                    </div>
                    <div className="flex space-x-3">
                        <Link href="/tickets/create">
                            <Button>📝 New Ticket</Button>
                        </Link>
                        {isAdmin && (
                            <Link href="/inventory-items/create">
                                <Button variant="outline">➕ Add Inventory</Button>
                            </Link>
                        )}
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {isAdmin && (
                        <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                            <div className="flex items-center">
                                <div className="flex-shrink-0">
                                    <div className="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <span className="text-white text-sm">👥</span>
                                    </div>
                                </div>
                                <div className="ml-4">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                        {stats.employees}
                                    </h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Total Employees</p>
                                </div>
                            </div>
                        </div>
                    )}

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white text-sm">📦</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    {isAdmin ? stats.inventory_items : stats.assigned_items}
                                </h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    {isAdmin ? 'Total Inventory' : 'Assigned to You'}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white text-sm">🎫</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    {stats.total_tickets}
                                </h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    {isAdmin ? 'Total Tickets' : 'Your Tickets'}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white text-sm">🚨</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    {stats.open_tickets}
                                </h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Open Tickets</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Ticket Status Overview */}
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        🎯 Ticket Status Overview
                    </h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div className="text-center">
                            <div className="text-2xl font-bold text-red-600">{stats.open_tickets}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-400">Open</div>
                        </div>
                        <div className="text-center">
                            <div className="text-2xl font-bold text-yellow-600">{stats.in_progress_tickets}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-400">In Progress</div>
                        </div>
                        <div className="text-center">
                            <div className="text-2xl font-bold text-green-600">{stats.resolved_tickets}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-400">Resolved</div>
                        </div>
                        <div className="text-center">
                            <div className="text-2xl font-bold text-blue-600">
                                {stats.total_tickets - stats.open_tickets - stats.in_progress_tickets - stats.resolved_tickets}
                            </div>
                            <div className="text-sm text-gray-600 dark:text-gray-400">Closed</div>
                        </div>
                    </div>
                </div>

                <div className="grid lg:grid-cols-2 gap-6">
                    {/* Recent Tickets */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                        <div className="flex items-center justify-between mb-4">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                🎫 Recent Tickets
                            </h2>
                            <Link href="/tickets">
                                <Button variant="outline" size="sm">View All</Button>
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recentTickets.length > 0 ? (
                                recentTickets.map((ticket) => (
                                    <div key={ticket.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                {ticket.title}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                by {ticket.created_by.name} • {new Date(ticket.created_at).toLocaleDateString()}
                                            </p>
                                        </div>
                                        <div className="flex space-x-2">
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getPriorityColor(ticket.priority)}`}>
                                                {ticket.priority}
                                            </span>
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(ticket.status)}`}>
                                                {ticket.status}
                                            </span>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    No tickets yet
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Recent Inventory Items */}
                    {isAdmin && (
                        <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                            <div className="flex items-center justify-between mb-4">
                                <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
                                    📦 Recent Inventory
                                </h2>
                                <Link href="/inventory-items">
                                    <Button variant="outline" size="sm">View All</Button>
                                </Link>
                            </div>
                            <div className="space-y-3">
                                {recentItems.length > 0 ? (
                                    recentItems.map((item) => (
                                        <div key={item.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                    {item.name}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {item.brand} {item.model} • {item.category.name}
                                                    {item.assigned_employee && ` • Assigned to ${item.assigned_employee.name}`}
                                                </p>
                                            </div>
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(item.status)}`}>
                                                {item.status}
                                            </span>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                        No inventory items yet
                                    </p>
                                )}
                            </div>
                        </div>
                    )}
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        ⚡ Quick Actions
                    </h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <Link href="/tickets/create">
                            <Button className="w-full justify-center" variant="outline">
                                📝 Create Ticket
                            </Button>
                        </Link>
                        <Link href="/tickets">
                            <Button className="w-full justify-center" variant="outline">
                                🎫 View Tickets
                            </Button>
                        </Link>
                        {isAdmin && (
                            <>
                                <Link href="/inventory-items">
                                    <Button className="w-full justify-center" variant="outline">
                                        📦 Inventory
                                    </Button>
                                </Link>
                                <Link href="/employees">
                                    <Button className="w-full justify-center" variant="outline">
                                        👥 Employees
                                    </Button>
                                </Link>
                            </>
                        )}
                    </div>
                </div>
            </div>
        </AppShell>
    );
}