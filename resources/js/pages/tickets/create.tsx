import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

export default function CreateTicket() {
    const [formData, setFormData] = useState({
        title: '',
        description: '',
        priority: 'Medium',
    });
    const [errors, setErrors] = useState<Record<string, string>>({});
    const [isSubmitting, setIsSubmitting] = useState(false);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);
        setErrors({});

        router.post('/tickets', formData, {
            onSuccess: () => {
                // Success handled by redirect
            },
            onError: (errors) => {
                setErrors(errors);
                setIsSubmitting(false);
            },
            onFinish: () => {
                setIsSubmitting(false);
            },
        });
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
        setFormData(prev => ({
            ...prev,
            [e.target.name]: e.target.value
        }));
        
        // Clear error when user starts typing
        if (errors[e.target.name]) {
            setErrors(prev => ({
                ...prev,
                [e.target.name]: ''
            }));
        }
    };

    return (
        <AppShell variant="sidebar">
            <Head title="Create Support Ticket" />
            
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            📝 Create Support Ticket
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Submit a new IT support request
                        </p>
                    </div>
                    <Link href="/tickets">
                        <Button variant="outline">← Back to Tickets</Button>
                    </Link>
                </div>

                {/* Form */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div className="p-6">
                        <form onSubmit={handleSubmit} className="space-y-6">
                            {/* Title */}
                            <div>
                                <label htmlFor="title" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ticket Title *
                                </label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value={formData.title}
                                    onChange={handleChange}
                                    className={`w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white ${
                                        errors.title 
                                            ? 'border-red-500 dark:border-red-500' 
                                            : 'border-gray-300 dark:border-gray-600'
                                    }`}
                                    placeholder="Brief description of the issue"
                                    required
                                />
                                {errors.title && (
                                    <p className="mt-1 text-sm text-red-600 dark:text-red-400">{errors.title}</p>
                                )}
                            </div>

                            {/* Priority */}
                            <div>
                                <label htmlFor="priority" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Priority *
                                </label>
                                <select
                                    id="priority"
                                    name="priority"
                                    value={formData.priority}
                                    onChange={handleChange}
                                    className={`w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white ${
                                        errors.priority 
                                            ? 'border-red-500 dark:border-red-500' 
                                            : 'border-gray-300 dark:border-gray-600'
                                    }`}
                                    required
                                >
                                    <option value="Low">🟢 Low - Minor issue, not urgent</option>
                                    <option value="Medium">🟡 Medium - Normal priority</option>
                                    <option value="High">🔴 High - Urgent, blocking work</option>
                                </select>
                                {errors.priority && (
                                    <p className="mt-1 text-sm text-red-600 dark:text-red-400">{errors.priority}</p>
                                )}
                            </div>

                            {/* Description */}
                            <div>
                                <label htmlFor="description" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Description *
                                </label>
                                <textarea
                                    id="description"
                                    name="description"
                                    value={formData.description}
                                    onChange={handleChange}
                                    rows={6}
                                    className={`w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white ${
                                        errors.description 
                                            ? 'border-red-500 dark:border-red-500' 
                                            : 'border-gray-300 dark:border-gray-600'
                                    }`}
                                    placeholder="Please provide detailed information about your issue:
- What were you trying to do?
- What happened instead?
- Any error messages?
- Steps to reproduce the issue
- When did this start happening?"
                                    required
                                />
                                {errors.description && (
                                    <p className="mt-1 text-sm text-red-600 dark:text-red-400">{errors.description}</p>
                                )}
                            </div>

                            {/* Submit Button */}
                            <div className="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <Link href="/tickets">
                                    <Button variant="outline" disabled={isSubmitting}>
                                        Cancel
                                    </Button>
                                </Link>
                                <Button type="submit" disabled={isSubmitting}>
                                    {isSubmitting ? 'Creating...' : '🎫 Create Ticket'}
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>

                {/* Help Text */}
                <div className="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <h3 className="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">
                        💡 Tips for Better Support
                    </h3>
                    <ul className="text-sm text-blue-700 dark:text-blue-300 space-y-1">
                        <li>• Be specific about the issue and when it occurs</li>
                        <li>• Include any error messages or screenshots if available</li>
                        <li>• Mention what you were doing when the problem happened</li>
                        <li>• Choose the appropriate priority level for faster response</li>
                    </ul>
                </div>
            </div>
        </AppShell>
    );
}