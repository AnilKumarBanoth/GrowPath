@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 py-8">
        <div class="w-full max-w-2xl bg-white p-10 rounded-2xl shadow-lg">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Create a New Club</h2>

            <form action="{{ route('clubs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Club Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Club Name</label>
                    <input type="text" name="name" id="name" placeholder="E.g. Photography Club"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700"
                        required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="What is your club about?"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700 resize-none"
                        required></textarea>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input type="text" name="category" id="category" placeholder="E.g. Art, Sports, Tech"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700"
                        required>
                </div>

                <!-- Founded Date -->
                <div>
                    <label for="founded_date" class="block text-sm font-medium text-gray-700 mb-1">Founded Date</label>
                    <input type="date" name="founded_date" id="founded_date"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700">
                </div>

                <!-- Contact Email -->
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email" placeholder="e.g. club@example.com"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700"
                        required>
                </div>

                <!-- Contact Phone -->
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                    <input type="tel" name="contact_phone" id="contact_phone" placeholder="e.g. +91 9876543210"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700"
                        required>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Club Address</label>
                    <input type="text" name="address" id="address" placeholder="e.g. Block A, LPU Campus"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700"
                        required>
                </div>

                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website <span
                            class="text-gray-400 text-sm">(optional)</span></label>
                    <input type="url" name="website" id="website" placeholder="https://yourclubsite.com"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700">
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition-all duration-200 ease-in-out">
                        Create Club
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection