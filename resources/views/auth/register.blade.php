<x-guest-layout>
    <!-- Подключаем IMask через CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.4.3/imask.min.js"></script>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Middlename -->
        <div class="mt-4">
            <x-input-label for="middlename" :value="__('Middlename')" />
            <x-text-input id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename')" required autocomplete="middlename" />
            <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autocomplete="username" placeholder="some@some.some" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Login -->
        <div class="mt-4">
            <x-input-label for="login" :value="__('Login')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autocomplete="login" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Tel -->
        <div class="mt-4">
            <x-input-label for="tel" :value="__('Tel')" />
            <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required autocomplete="tel" placeholder="+7(000)000-00-00"/>
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Функция для автоматической капитализации первой буквы
            function capitalizeFirstLetter(inputElement) {
                inputElement.addEventListener('input', function(e) {
                    const cursorPosition = e.target.selectionStart;
                    const value = e.target.value;
                    
                    if (value.length === 1) {
                        // Если введен один символ - делаем его заглавным
                        e.target.value = value.toUpperCase();
                        e.target.setSelectionRange(1, 1);
                    } else if (value.length > 1 && !value[0].match(/[A-ZА-Я]/)) {
                        // Если первая буква не заглавная - исправляем
                        const capitalized = value.charAt(0).toUpperCase() + value.slice(1);
                        e.target.value = capitalized;
                        
                        // Восстанавливаем позицию курсора
                        if (cursorPosition === 1) {
                            e.target.setSelectionRange(1, 1);
                        } else {
                            e.target.setSelectionRange(cursorPosition, cursorPosition);
                        }
                    }
                });

                // Также обрабатываем событие blur на случай, если пользователь перешел к другому полю
                inputElement.addEventListener('blur', function(e) {
                    const value = e.target.value;
                    if (value.length > 0 && !value[0].match(/[A-ZА-Я]/)) {
                        e.target.value = value.charAt(0).toUpperCase() + value.slice(1);
                    }
                });
            }

            // Применяем капитализацию к нужным полям
            const nameFields = ['name', 'middlename', 'lastname'];
            nameFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    capitalizeFirstLetter(field);
                }
            });

            // Маска для телефона
            var phoneElement = document.getElementById('tel');
            if (phoneElement) {
                var phoneMask = IMask(phoneElement, {
                    mask: '+7(000)000-00-00',
                    lazy: false
                });
            }

            // Маска для email (кастомная валидация)
            var emailElement = document.getElementById('email');
            if (emailElement) {
                var emailMask = IMask(emailElement, {    
                    mask: function (value) {
                        if(/^[a-z0-9_\.-]+$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value))
                            return true;
                        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value))
                            return true;
                        return false;
                    },
                    lazy: false
                });
            }
        });
    </script>

    <style>
        /* Стили для поля номера карты */
        #card {
            font-family: monospace; 
            letter-spacing: 2px;
        }
        
        /* Общие стили для всех полей ввода */
        .block.mt-1.w-full {
            font-family: sans-serif;
        }
    </style>
</x-guest-layout>