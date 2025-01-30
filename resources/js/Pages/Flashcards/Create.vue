<template>
    <div>
        <h1 class="text-center text-3xl mb-5">Añadir tarjeta nueva</h1>
        <form @submit.prevent="createFlashcard">
            <div>
                <label for="palabra">Palabra:</label>
                <input
                    type="text"
                    v-model="flashcard.palabra"
                    id="palabra"
                    placeholder="Palabra"
                    required
                    :class="{ 'is-invalid': form.errors.palabra }"
                />
                <span v-if="form.errors.palabra" class="text-red-500">{{
                    form.errors.palabra
                }}</span>
            </div>
            <div>
                <label for="traduccion">Traducción:</label>
                <input
                    type="text"
                    v-model="flashcard.traduccion"
                    id="traduccion"
                    required
                    placeholder="Traducción"
                    :class="{ 'is-invalid': form.errors.traduccion }"
                />
                <span v-if="form.errors.traduccion" class="text-red-500">{{
                    form.errors.traduccion
                }}</span>
            </div>
            <div>
                <label for="cat_gramatical">Categoría Gramatical:</label>
                <input
                    type="text"
                    v-model="flashcard.cat_gramatical"
                    id="cat_gramatical"
                    placeholder="opcional"
                    :class="{ 'is-invalid': form.errors.cat_gramatical }"
                />
                <span v-if="form.errors.cat_gramatical" class="text-red-500">{{
                    form.errors.cat_gramatical
                }}</span>
            </div>
            <div>
                <label for="pronunciacion">Pronunciación:</label>
                <input
                    type="text"
                    v-model="flashcard.pronunciacion"
                    id="pronunciacion"
                    placeholder="opcional"
                    :class="{ 'is-invalid': form.errors.pronunciacion }"
                />
                <span v-if="form.errors.pronunciacion" class="text-red-500">{{
                    form.errors.pronunciacion
                }}</span>
            </div>
            <div>
                <label for="frase_ejemplo">Frase de ejemplo:</label>
                <textarea
                    v-model="flashcard.frase_ejemplo"
                    id="frase_ejemplo"
                    required
                    :class="{ 'is-invalid': form.errors.frase_ejemplo }"
                ></textarea>
                <span v-if="form.errors.frase_ejemplo" class="text-red-500">{{
                    form.errors.frase_ejemplo
                }}</span>
            </div>
            <div>
                <label for="notas">Notas adicionales:</label>
                <textarea
                    v-model="flashcard.notas"
                    :class="{ 'is-invalid': form.errors.notas }"
                    id="notas"
                ></textarea>
                <span v-if="form.errors.notas" class="text-red-500">{{
                    form.errors.notas
                }}</span>
            </div>
            <button type="submit" :disabled="form.processing">
                Añadir tarjeta
            </button>
        </form>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        listId: Number,
    },
    data() {
        return {
            flashcard: {
                palabra: "",
                traduccion: "",
                cat_gramatical: "",
                pronunciacion: "",
                frase_ejemplo: "",
                notas: "",
            },
            form: {
                errors: {},
                processing: false,
            },
        };
    },
    methods: {
        async createFlashcard() {
            this.form.errors = {}; // borrar errores anteriores
            this.form.processing = true;

            try {
                await Inertia.post(
                    `/lists/${this.listId}/flashcards`,
                    this.flashcard
                );
            } catch (e) {
                this.form.errors = e.response.data.errors;
            } finally {
                this.form.processing = false;
            }
        },
    },
};
</script>
