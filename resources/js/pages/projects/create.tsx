import {Link, useForm} from '@inertiajs/react';
import {FormEventHandler} from "react";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import InputError from "@/components/input-error";
import {Button} from "@/components/ui/button";
import {LoaderCircle} from "lucide-react";
import AppLayout from "@/layouts/app-layout";
import {toast} from "sonner";

type CreateProjectForm = {
    name: string;
    start_date: string;
    status: string;
    responsible: string;
    amount: string;
};

function Create() {
    const { data, setData, post, processing, errors, reset } = useForm<Required<CreateProjectForm>>({
        name: '',
        start_date: '',
        status: '',
        responsible: '',
        amount: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('projects.store'), {
            onSuccess: () => {
                toast("Project created successfully", {
                    description: 'The project has been created successfully.',
                    duration: 5000,
                    action: {
                        label: 'Close',
                        onClick: () => toast.dismiss(),
                    },
                });
            },
            onFinish: () => reset('name', 'start_date', 'status', 'responsible', 'amount'),
        });
    };

    return (
        <AppLayout>
            <div className='p-4'>
                <form className="grid gap-6 border rounded-xl p-4" onSubmit={submit}>
                    <div className="grid gap-2">
                        <Label htmlFor="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="name"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            disabled={processing}
                            placeholder="Full name"
                        />
                        <InputError message={errors.name} className="mt-2"/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="startDate">Start Date</Label>
                        <Input
                            id="startDate"
                            type="date"
                            required
                            tabIndex={2}
                            autoComplete="startDate"
                            value={data.start_date}
                            onChange={(e) => setData('start_date', e.target.value)}
                            disabled={processing}
                        />
                        <InputError message={errors.start_date} className="mt-2"/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="status">Status</Label>
                        <Input
                            id="status"
                            type="text"
                            required
                            tabIndex={3}
                            autoComplete="status"
                            value={data.status}
                            onChange={(e) => setData('status', e.target.value)}
                            disabled={processing}
                        />
                        <InputError message={errors.status} className="mt-2"/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="responsible">Responsible</Label>
                        <Input
                            id="responsible"
                            type="text"
                            required
                            tabIndex={4}
                            autoComplete="responsible"
                            value={data.responsible}
                            onChange={(e) => setData('responsible', e.target.value)}
                            disabled={processing}
                        />
                        <InputError message={errors.responsible} className="mt-2"/>
                    </div>

                    <div className="grid gap-2">
                        <Label htmlFor="amount">Amount</Label>
                        <Input
                            id="amount"
                            type="number"
                            required
                            tabIndex={5}
                            autoComplete="amount"
                            value={data.amount}
                            onChange={(e) => setData('amount', e.target.value)}
                            disabled={processing}
                        />
                        <InputError message={errors.amount} className="mt-2"/>
                    </div>

                    <Button type="submit" className="mt-2 w-full" tabIndex={5} disabled={processing}>
                        {processing && <LoaderCircle className="h-4 w-4 animate-spin"/>}
                        Create project
                    </Button>
                    <Link href={route('projects.index')} className="w-full">
                        <Button variant="secondary" className="w-full">
                            Back to projects
                        </Button>
                    </Link>
                </form>
            </div>
        </AppLayout>
    )
}

export default Create;
