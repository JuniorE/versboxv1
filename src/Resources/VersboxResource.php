<?php
    /**
     * Created by PhpStorm.
     * User: JuniorE.
     * Date: 2019-03-11
     * Time: 19:35
     */

    namespace JuniorE\Versbox\Resources;


    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * @property mixed code
     * @property mixed succes
     * @property mixed message
     * @property mixed apiReference
     */
    class VersboxResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param Request $request
         * @return array
         */
        public function toArray($request): array
        {
            return [
                'code'         => $this->code,
                'success'      => $this->succes,
                'message'      => $this->message,
                'apiReference' => $this->apiReference
            ];
        }
    }