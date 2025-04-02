import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import InputError from "@/components/input-error";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select";
import {useEffect} from "react";

export type ProjectFormData = {
    name: string;
    start_date: string;
    status: string;
    responsible: string;
    amount: string;
}

type FormProps = {
    data: Required<ProjectFormData>
    setData: ( name: string, value: string | number ) => void;
    processing: boolean;
    errors: Record<string, string>;
}

function Form({ data, setData, processing, errors }: FormProps) {
    useEffect(() => {
        console.log('Form data:', data);
    }, [data]);
    return (
        <>
            <div className="grid gap-2">
                <Label htmlFor="name">Nombre</Label>
                <Input
                    id="name"
                    name="name"
                    type="text"
                    required
                    autoFocus
                    tabIndex={1}
                    autoComplete="name"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    disabled={processing}
                    placeholder="Ingresa el nombre del proyecto"
                />
                <InputError message={errors.name} className="mt-2"/>
            </div>

            <div className="grid gap-2">
                <Label htmlFor="start_date">Fecha de inicio</Label>
                <Input
                    id="start_date"
                    type="date"
                    required
                    tabIndex={2}
                    autoComplete="start_date"
                    value={data.start_date}
                    onChange={(e) => setData('start_date', e.target.value)}
                    disabled={processing}
                />
                <InputError message={errors.start_date} className="mt-2"/>
            </div>

            <div className="grid gap-2">
                <Label htmlFor="status">Estado</Label>
                <Select
                    defaultValue={data.status}
                    onValueChange={(value) => setData('status', value)}
                    disabled={processing}
                    required
                >
                    <SelectTrigger className="w-[180px]">
                        <SelectValue placeholder="Selecciona un estado"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Selecciona un estado</SelectLabel>
                            <SelectItem value="active">Activo</SelectItem>
                            <SelectItem value="inactive">Inactivo</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <InputError message={errors.status} className="mt-2"/>
            </div>

            <div className="grid gap-2">
                <Label htmlFor="responsible">Responsable</Label>
                <Input
                    id="responsible"
                    type="text"
                    required
                    tabIndex={4}
                    autoComplete="responsible"
                    value={data.responsible}
                    onChange={(e) => setData('responsible', e.target.value)}
                    disabled={processing}
                    placeholder="Nombre del responsable del proyecto..."
                />
                <InputError message={errors.responsible} className="mt-2"/>
            </div>

            <div className="grid gap-2">
                <Label htmlFor="amount">Monto</Label>
                <Input
                    id="amount"
                    type="number"
                    required
                    tabIndex={5}
                    autoComplete="amount"
                    value={data.amount}
                    onChange={(e) => setData('amount', e.target.value)}
                    disabled={processing}
                    placeholder="Monto del proyecto..."
                />
                <InputError message={errors.amount} className="mt-2"/>
            </div>
        </>);
}

export default Form;
