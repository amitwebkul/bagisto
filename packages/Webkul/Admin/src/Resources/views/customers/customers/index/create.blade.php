@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-create-customer-form-template"
    >
        <x-admin::form
            v-slot="{ meta, errors, handleSubmit }"
            as="div"
        >
            <form @submit="handleSubmit($event, create)">
                <!-- Customer Create Modal -->
                <x-admin::modal ref="customerCreateModal">
                    <!-- Modal Header -->
                    <x-slot:header>
                        <p class="text-lg font-bold text-gray-800 dark:text-white">
                            @lang('admin::app.customers.customers.index.create.title')
                        </p>
                    </x-slot>

                    <!-- Modal Content -->
                    <x-slot:content>
                        {!! view_render_event('bagisto.admin.customers.create.before') !!}

                        <div class="flex gap-4 max-sm:flex-wrap">
                            <!-- First Name -->
                            <x-admin::form.control-group class="mb-2.5 w-full">
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.customers.customers.index.create.first-name')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    rules="required"
                                    :label="trans('admin::app.customers.customers.index.create.first-name')"
                                    :placeholder="trans('admin::app.customers.customers.index.create.first-name')"
                                />

                                <x-admin::form.control-group.error control-name="first_name" />
                            </x-admin::form.control-group>

                            <!-- Last Name -->
                            <x-admin::form.control-group class="mb-2.5 w-full">
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.customers.customers.index.create.last-name')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    rules="required"
                                    :label="trans('admin::app.customers.customers.index.create.last-name')"
                                    :placeholder="trans('admin::app.customers.customers.index.create.last-name')"
                                />

                                <x-admin::form.control-group.error control-name="last_name" />
                            </x-admin::form.control-group>
                        </div>

                        <!-- Email -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.customers.customers.index.create.email')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="email"
                                id="email"
                                name="email"
                                rules="required|email"
                                :label="trans('admin::app.customers.customers.index.create.email')"
                                placeholder="email@example.com"
                            />

                            <x-admin::form.control-group.error control-name="email" />
                        </x-admin::form.control-group>

                        <!-- Contact Number -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                @lang('admin::app.customers.customers.index.create.contact-number')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                id="phone"
                                name="phone"
                                rules="phone"
                                :label="trans('admin::app.customers.customers.index.create.contact-number')"
                                :placeholder="trans('admin::app.customers.customers.index.create.contact-number')"
                            />

                            <x-admin::form.control-group.error control-name="phone" />
                        </x-admin::form.control-group>

                        <div class="flex gap-4 max-sm:flex-wrap">
                            <!-- DOB -->
                            <x-admin::form.control-group class="w-full">
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.customers.customers.index.create.date-of-birth')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="date"
                                    id="dob"
                                    name="date_of_birth"
                                    :label="trans('admin::app.customers.customers.index.create.date-of-birth')"
                                    :placeholder="trans('admin::app.customers.customers.index.create.date-of-birth')"
                                />

                                <x-admin::form.control-group.error control-name="date_of_birth" />
                            </x-admin::form.control-group>

                            <!-- Channel Id -->
                            <x-admin::form.control-group class="w-full">
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.customers.customers.index.create.channel')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="select"
                                    id="channel_id"
                                    name="channel_id"
                                    rules="required"
                                    :label="trans('admin::app.customers.customers.index.create.channel')"
                                >
                                    <option value="">
                                        @lang('admin::app.customers.customers.index.create.select-channel')
                                    </option>

                                    @foreach (core()->getAllChannels() as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name}}
                                        </option>
                                    @endforeach
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="channel_id" />
                            </x-admin::form.control-group>
                        </div>

                        <div class="flex gap-4 max-sm:flex-wrap">
                            <!-- Gender -->
                            <x-admin::form.control-group class="w-full">
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.customers.customers.index.create.gender')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="select"
                                    id="gender"
                                    name="gender"
                                    rules="required"
                                    :label="trans('admin::app.customers.customers.index.create.gender')"
                                >
                                    <option value="">
                                        @lang('admin::app.customers.customers.index.create.select-gender')
                                    </option>

                                    <option value="Male">
                                        @lang('admin::app.customers.customers.index.create.male')
                                    </option>

                                    <option value="Female">
                                        @lang('admin::app.customers.customers.index.create.female')
                                    </option>

                                    <option value="Other">
                                        @lang('admin::app.customers.customers.index.create.other')
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="gender" />
                            </x-admin::form.control-group>

                            <!-- Customer Group -->
                            <x-admin::form.control-group class="w-full">
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.customers.customers.index.create.customer-group')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="select"
                                    id="customerGroup"
                                    name="customer_group_id"
                                    :label="trans('admin::app.customers.customers.index.create.customer-group')"
                                    ::value="groups[0]?.id"
                                >
                                    <option 
                                        v-for="group in groups" 
                                        :value="group.id"
                                        selected
                                    > 
                                        @{{ group.name }} 
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="customer_group_id" />
                            </x-admin::form.control-group>
                        </div>

                        {!! view_render_event('bagisto.admin.customers.create.after') !!}
                    </x-slot>

                    <!-- Modal Footer -->
                    <x-slot:footer>
                        <!-- Save Button -->
                        <x-admin::button
                            button-type="submit"
                            class="primary-button justify-center"
                            :title="trans('admin::app.customers.customers.index.create.save-btn')"
                            ::loading="isLoading"
                            ::disabled="isLoading"
                        />
                    </x-slot>
                </x-admin::modal>
            </form>
        </x-admin::form>
    </script>

    <script type="module">
        app.component('v-create-customer-form', {
            template: '#v-create-customer-form-template',

            data() {
                return {
                    groups: @json($groups),

                    isLoading: false,
                };
            },

            methods: {
                openModal() {
                    this.$refs.customerCreateModal.open();
                },

                create(params, { resetForm, setErrors }) {
                    this.isLoading = true;

                    this.$axios.post("{{ route('admin.customers.customers.store') }}", params)
                        .then((response) => {
                            this.$refs.customerCreateModal.close();

                            this.$emit('customer-created', response.data.data);

                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                            resetForm();

                            this.isLoading = false;
                        })
                        .catch(error => {                            
                            this.isLoading = false;

                            if (error.response.status == 422) {
                                setErrors(error.response.data.errors);
                            }
                        });
                }
            }
        })
    </script>
@endPushOnce