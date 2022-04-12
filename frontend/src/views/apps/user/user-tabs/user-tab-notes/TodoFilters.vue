
<template>
    <div class="todo__filters-container">

        <!-- all -->
        <!-- <div class="px-6 py-4">
            <router-link tag="span" class="flex cursor-pointer" :class="{'text-primary': todoFilter == 'all'}" :to="`${baseUrl}/all`">
                <feather-icon icon="LayersIcon" :svgClasses="[{'text-primary stroke-current': todoFilter == 'all'}, 'h-6 w-6']"></feather-icon>
                <span class="text-lg ml-3">All</span>
            </router-link>
        </div> -->

        <vs-divider v-if="todoFilters"></vs-divider>

        <!-- starred -->
        <div class="px-6 py-4" v-if="todoFilters">
            <h5>Filters</h5>

            <template v-for="filter in todoFilters">
                <router-link tag="span" class="flex mt-6 cursor-pointer" :class="{'text-primary': todoFilter == filter.filter}" :to="`${baseUrl}/${filter.filter}`" :key="filter.filter">
                    <feather-icon :icon="filter.icon" :svgClasses="[{'text-primary stroke-current': todoFilter == filter.filter}, 'h-6 w-6']"></feather-icon>
                    <span class="text-lg ml-3">{{ filter.filterName }}</span>
                </router-link>
            </template>

        </div>

        <vs-divider></vs-divider>

        <div class="px-6 py-4" v-if="taskTags">
            <h5>Note Type</h5>
            <div class="todo__lables-list">
                <router-link tag="span" class="todo__label flex items-center mt-6 cursor-pointer" v-for="(tag, index) in taskTags" :key="index" :to="`${baseUrl}/${tag.value}`">
                    <div class="ml-1 h-3 w-3 rounded-full mr-4" :class="'border-2 border-solid border-' + tag.color" />
                    <span class="text-lg" :class="{'text-primary': todoFilter == tag.value}">{{ tag.text }}</span>
                </router-link>
            </div>
        </div>

    </div>
</template>

<script>

export default{
  data () {
    return {
      todoFilters: ''/*[
        { filterName: 'Starred', filter: 'starred', icon: 'StarIcon' },
        { filterName: 'Important', filter: 'important', icon: 'InfoIcon' },
        { filterName: 'Completed', filter: 'completed', icon: 'CheckIcon' },
        { filterName: 'Trashed', filter: 'trashed', icon: 'TrashIcon' }
      ]*/
    }
  },
  computed: {
    taskTags () {
      /*return [
            {
                text: 'General',
                value: '1',
                color: 'primary'
            },
            {
                text: 'Follow Up',
                value: '2',
                color: 'info'
            }
      ];*/
    },
    todoFilter () {
      return this.$route.params.filter
    },
    baseUrl () {
      const path = this.$route.path
      return path.slice(0, path.lastIndexOf('/'))
    }
  }
}
</script>
