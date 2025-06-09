<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="font-semibold text-xl text-indigo-800 leading-tight">
                        {{ __('Meu Perfil') }}
                    </h2>
                </div>

                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-indigo-800">
                                {{ __('Informações do Perfil') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Atualize as informações do seu perfil e seu endereço de e-mail.') }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div x-data="{ photoPreview: null }" class="flex items-center space-x-4">
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-20 h-20 rounded-full object-cover ring-2 ring-indigo-500">
                                </template>

                                <template x-if="!photoPreview">
                                    @if (Auth::user()->profilePhoto)
                                        <img src="{{ Auth::user()->profilePhoto->url }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="w-20 h-20 rounded-full object-cover ring-2 ring-indigo-500">
                                    @else
                                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center ring-2 ring-indigo-500">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </template>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('Foto de Perfil') }}</label>

                                    <label for="profile_photo" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 cursor-pointer transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Selecionar Imagem') }}
                                    </label>
                                    <input id="profile_photo" name="profile_photo" type="file" accept="image/*" class="hidden"
                                           @change="const reader = new FileReader(); reader.onload = (e) => photoPreview = e.target.result; reader.readAsDataURL($event.target.files[0])">
                                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="name" value="{{ __('Nome') }}" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('E-mail')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Seu endereço de e-mail não está verificado.') }}

                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('Um novo link de verificação foi enviado para seu e-mail.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div>
                                <x-input-label for="birth_date" :value="__('Data de Nascimento')" />
                                <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date->format('Y-m-d'))" />
                                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                            </div>

                            <div>
                                <x-input-label for="gender" :value="__('Gênero')" />
                                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('Selecione...') }}</option>
                                    <option value="masculino" {{ old('gender', $user->gender) == 'masculino' ? 'selected' : '' }}>{{ __('Masculino') }}</option>
                                    <option value="feminino" {{ old('gender', $user->gender) == 'feminino' ? 'selected' : '' }}>{{ __('Feminino') }}</option>
                                    <option value="outro" {{ old('gender', $user->gender) == 'outro' ? 'selected' : '' }}>{{ __('Outro') }}</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Telefone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" placeholder="(00) 00000-0000" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="bio" :value="__('Biografia')" />
                                <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                            </div>

                            <div class="flex items-center">
                                <x-checkbox id="goals_visibility" name="goals_visibility" :checked="old('goals_visibility', $user->goals_visibility)" />
                                <x-input-label for="goals_visibility" class="ml-2" :value="__('Permitir que minhas metas sejam públicas')" />
                                <x-input-error class="mt-2" :messages="$errors->get('goals_visibility')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ __('Salvar') }}
                                </x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Salvo.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 space-y-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
