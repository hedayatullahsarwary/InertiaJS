<template v-if="activity.icon">
  <h1 class="text-3xl">
    Users
  </h1>

  <div style="margin-top:400px;">
    <p>The current time is {{ time }}.</p>

    <Link href="/users" class="text-blue-500" preserve-scroll>
      Refresh
    </Link>
  </div>
</template>

<!-- <script setup>
    import Layout from "../Shared/Layout";
    import { Link } from "@inertiajs/inertia-vue3";

    export default {
      layout: Layout
    };

    defineProps({
        time: String
    });

    export default {
        components: { Layout, Link },

        props: { time: String }
    };
</script> -->

<script>
    export default {
      props: { time: String }
    };
</script>