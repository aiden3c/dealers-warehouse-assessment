<template>
    <div class="w-full h-24 p-2 m-2 rounded-md border-2 border-gray-300">
        <a :href="'/customers/' + JSON.parse(customer).account_number" class="grid grid-cols-2">
            <div class="w-full">
                <div>
                    <span class="text-xl font-bold inline-block">
                        {{ JSON.parse(customer).name }}
                    </span>
                    <span class="text-sm text-gray-500 ">
                        &nbsp;({{ JSON.parse(customer).business_type }})
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    {{ JSON.parse(customer).email }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ JSON.parse(customer).phone }}
                </div>
            </div>
            <div class="w-full">
                <div class="text-xl font-bold">
                    {{ JSON.parse(customer).address_1 }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ JSON.parse(customer).city }}, {{ JSON.parse(customer).state }} {{ JSON.parse(customer).zip }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ JSON.parse(customer).availability }}
                </div>
            </div>
        </a>
    </div>
</template>

<script>
export default {
  name: "CustomerCard",
  props: [
    'customer'
  ]
};
</script>
