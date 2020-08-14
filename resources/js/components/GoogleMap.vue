<template>
    <div>
    <div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Location</label>
            <div class="col-md-6">
                <gmap-autocomplete class="col-md-7"
                    @place_changed="setPlace">

                </gmap-autocomplete >
                <button class="col-md-4" @click.prevent="addMarker">Add</button>
            </div>
        </div>


      <br/>

    </div>
    <br>
    <gmap-map
      :center="center"
      :zoom="12"
      style="width:100%;  height: 150px;"
    >
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        @click="center=m.position"
      ></gmap-marker>
    </gmap-map>
  </div>
</template>

<script>

export default {
    props: {
        position: {
            type: Object,
            default: undefined
        }
    },
    data() {
        return {
            markers: [],
            places: [],
            currentPlace: null
        };
    },

    mounted() {


        // console.log("meomeo");
    },

    computed: {
        center: function() {
            if (this.position)
            {
                return this.position;
            }
            console.log(this.geolocate);
            return this.geolocate;
        },

        geolocate: function() {
            // console.log("geolocate");
            var pos = {}
            navigator.geolocation.getCurrentPosition(position => {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
            return pos;
        }
    },

    methods: {
        // nhận địa điểm thông qua autocomplete component
        setPlace(place) {
            // console.log("set place");
            this.currentPlace = place;
            this.$emit('set-location', place)
        },
        addMarker() {

            if (this.currentPlace) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                // console.log(this.currentPlace);
                this.markers.push({ position: marker });
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
            }
        },

    }

};
</script>

<style >
    input[type=text],[type=email],[type=password] {
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size:16px;
        background-color: white;
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px;
    }


</style>
